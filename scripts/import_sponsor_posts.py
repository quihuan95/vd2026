import json
from pathlib import Path

import fitz
from PIL import Image

ROOT = Path(r"d:\Code\work\vduh-app\BÀI ĐĂNG WEBSITE")
OUT = Path(r"d:\Code\work\vduh-app\public\images\sponsor-posts")

FOLDERS = {
    "10. Medicent (Solventum Việt Nam)": (["Công ty TNHH Solventum Việt Nam", "Công ty TNHH Thiết bị y tế Medicent"], "solventum"),
    "11. CZ PHARMA": (["Công ty TNHH CZPHARMA"], "czpharma"),
    "12. HOÀNG ĐỨC": (["Hoàng Đức"], "hoang-duc"),
    "13. ASTRAZENECA": (["AstraZeneca"], "astrazeneca"),
    "15.NHẤT LÂM": (["Nhất Lâm - Nutridream"], "nhat-lam"),
    "16.  B. BRAUN": (["B. Braun", "Bbraun"], "b-braun"),
    "17. SANDOZ": (["Công ty TNHH Sandoz Việt Nam", "Công ty TNHH Sandoz Viet Nam"], "sandoz"),
    "19. DINH DƯỠNG 3A (VIỆT NAM)": (["Công ty TNHH Dinh dưỡng 3A (Việt Nam)"], "dinh-duong-3a"),
    "20. GRAVITAS": (["Gravitas - ProtiMedic"], "gravitas"),
    "22. BAXTER HEALTHCARE": (["Baxter"], "baxter"),
    "26. Abbott Laboratories": (["Abbott", "VPDD Abbott"], "abbott"),
    "27. BAYER": (["Công ty TNHH Bayer Việt Nam"], "bayer"),
    "28. Aspen Pharmacare": (["Aspen Pharmacare"], "aspen"),
    "29. DƯỢC PHẨM SANG (nhãn hàng của Menarini)": (["CÔNG TY TNHH THƯƠNG MẠI VÀ DƯỢC PHẨM SANG"], "sang"),
    "3.  JOHNSON & JOHNSON": (["Johnson & Johnson"], "johnson"),
    "30.  KHKT HÓA SINH": (["Công ty Hóa Sinh"], "hoa-sinh"),
    "31. THIẾT KẾ MỸ THUẬT DỊCH VỤ QUẢNG CÁO PHI LAO": (["Urgo"], "urgo"),
    "33. VANTIVE VIỆT NAM HEALTHCARE": (["Vantive"], "vantive"),
    "34. Gigamed ( nhãn hàng Italfarmaco)": (["Italfarmaco"], "italfarmaco"),
    "35. Thiết bị Minh Tâm": (["Thiết bị Minh Tâm"], "minh-tam"),
    "36. Thương mại - Dịch vụ Đồng Hữu": (["Dong Huu Co., Ltd."], "dong-huu"),
    "37. DƯỢC PHẨM VĨNH PHÚC": (["Vĩnh Phúc"], "vinh-phuc"),
    "4.  MEDTRONIC": (["Medtronic"], "medtronic"),
    "7.  KABI": (["Fresenius Kabi"], "fresenius-kabi"),
    "8. ZUELLIG PHARMA": (["Công ty TNHH Zuellig Pharma Việt Nam"], "zuellig"),
}


def is_post(path: Path) -> bool:
    if path.suffix.lower() not in {".pdf", ".jpg", ".jpeg", ".png", ".webp"}:
        return False
    lowered = path.name.lower()
    if "logo" in lowered or lowered.startswith("img_"):
        return False
    return True


# Nội dung vector nằm ngang nhưng trang PDF để dọc, không có cờ /Rotate.
ROTATE_CLOCKWISE = {"MEDTRONIC A4.pdf"}


def save_image(image: Image.Image, destination: Path, *, clockwise: bool = False) -> None:
    image = image.convert("RGB")
    if clockwise:
        image = image.transpose(Image.Transpose.ROTATE_270)
    image.thumbnail((1400, 2000), Image.Resampling.LANCZOS)
    image.save(destination, "PNG", optimize=True)


def render_pdf(path: Path, folder: Path, start: int) -> int:
    document = fitz.open(path)
    index = start
    for page in document:
        pixmap = page.get_pixmap(matrix=fitz.Matrix(1.6, 1.6), alpha=False)
        image = Image.frombytes("RGB", (pixmap.width, pixmap.height), pixmap.samples)
        index += 1
        destination = folder / f"{index:02d}.png"
        save_image(image, destination, clockwise=path.name in ROTATE_CLOCKWISE)
        print(f"  {destination.name} {image.size}")
    document.close()
    return index


catalog = {}
for folder_name, (names, slug) in FOLDERS.items():
    source = ROOT / folder_name
    target = OUT / slug
    target.mkdir(parents=True, exist_ok=True)
    for old in target.glob("*.png"):
        old.unlink()
    print(folder_name)
    page = 0
    for path in sorted(source.iterdir()):
        if not is_post(path):
            print("  skip", path.name)
            continue
        if path.suffix.lower() == ".pdf":
            page = render_pdf(path, target, page)
        else:
            page += 1
            image = Image.open(path)
            destination = target / f"{page:02d}.png"
            save_image(image, destination)
            print(f"  {destination.name} {image.size}")
    pages = [f"images/sponsor-posts/{slug}/{file.name}" for file in sorted(target.glob("*.png"))]
    for name in names:
        catalog[name] = pages

(OUT / "index.json").write_text(json.dumps(catalog, ensure_ascii=False, indent=2) + "\n", encoding="utf-8")
print("sponsors", len(catalog))
