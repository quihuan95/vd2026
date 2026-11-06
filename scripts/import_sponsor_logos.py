from pathlib import Path

import struct

import fitz
import numpy as np
from PIL import Image, ImageChops

ROOT = Path(r"d:\Code\work\vduh-app\NTT")
OUT = Path(r"d:\Code\work\vduh-app\public\images\sponsors")

TIERS = {
    "NTT KIM CƯƠNG": "diamond",
    "NTT BẠCH KIM": "platinum",
    "NTT VÀNG": "gold",
    "NTT BẠC": "silver",
    "NTT ĐỒNG": "bronze",
    "ĐỒNG TÀI TRỢ": "co_sponsor",
}


def sort_key(path: Path):
    stem = path.stem.strip()
    number = ""
    for char in stem:
        if char.isdigit():
            number += char
        else:
            break
    return (int(number) if number else 999, stem.lower())


def display_name(path: Path) -> str:
    stem = path.stem.strip()
    while stem and (stem[0].isdigit() or stem[0] in ".-_ "):
        stem = stem[1:].strip()
    stem = stem.replace("_", " ")
    stem = " ".join(stem.replace(".", " ").split())
    replacements = {
        "APM logo goc": "APM",
        "logo Pfizer": "Pfizer",
        "Astra Zeneca logo": "AstraZeneca",
        "Sanofi logo": "Sanofi",
        "Baxter logo": "Baxter",
        "MERCK LOGO BLUE RGB": "Merck",
        "logo Italfarmaco": "Italfarmaco",
        "Vantive logo": "Vantive",
        "Phi Lao (Urgo)": "Urgo",
        "Vĩnh Phúc -logo": "Vĩnh Phúc",
        "VPDD Abbott": "Abbott",
        "Nhãn hàng Teva Công ty TNHH Dược Phẩm Gigamed": "Teva - Công ty TNHH Dược Phẩm Gigamed",
        "CÔNG TY TNHH ZUELLIG PHARMA VIỆT NAM": "Công ty TNHH Zuellig Pharma Việt Nam",
        "LOGO CÔNG TY TNHH CZPHARMA": "Công ty TNHH CZPHARMA",
        "Cty Nhất Lâm -Logo Nutridream": "Nhất Lâm - Nutridream",
        "Cty TNHH Dinh dưỡng 3A( Việt Nam)": "Công ty TNHH Dinh dưỡng 3A (Việt Nam)",
        "CTy CP Gravitas-Logo ProtiMedic": "Gravitas - ProtiMedic",
        "Medcomtech-logo-FA Large": "Medcomtech",
        "TB MINH TÂM": "Thiết bị Minh Tâm",
        "VPĐD Aspen Pharmacare Asia Limited tại TP HCM": "Aspen Pharmacare",
        "Dong Huu Co , Ltd": "Dong Huu Co., Ltd.",
        "JOHNSON & JOHNSON": "Johnson & Johnson",
        "FRESENIUS KABI": "Fresenius Kabi",
        "Bbraun": "B. Braun",
        "Công ty TNHH Sandoz Viet Nam": "Công ty TNHH Sandoz Việt Nam",
    }
    return replacements.get(stem, stem)


def open_tiff(path: Path) -> Image.Image:
    data = path.read_bytes()
    entries = struct.unpack_from("<H", data, 8)[0]
    tags = {}
    offset = 10
    for _ in range(entries):
        tag, kind, count, value = struct.unpack_from("<HHII", data, offset)
        tags[tag] = (kind, count, value)
        offset += 12

    width = tags[0x100][2]
    height = tags[0x101][2]
    samples = tags[0x115][2]
    strip_offset = tags[0x111][2]
    strip_bytes = tags[0x117][2]
    raw = np.frombuffer(data[strip_offset:strip_offset + strip_bytes], dtype=np.uint8)
    pixels = raw.reshape((height, width, samples))
    cyan, magenta, yellow, black = [pixels[:, :, channel].astype(np.float32) / 255 for channel in range(4)]
    red = (255 * (1 - cyan) * (1 - black)).astype(np.uint8)
    green = (255 * (1 - magenta) * (1 - black)).astype(np.uint8)
    blue = (255 * (1 - yellow) * (1 - black)).astype(np.uint8)
    channels = [red, green, blue]
    if samples >= 5:
        channels.append(pixels[:, :, 4])
    return Image.fromarray(np.dstack(channels), "RGBA" if samples >= 5 else "RGB")


def render_pdf(path: Path) -> Image.Image:
    document = fitz.open(path)
    page = document[0]
    pixmap = page.get_pixmap(matrix=fitz.Matrix(3, 3), alpha=True)
    image = Image.frombytes("RGBA", (pixmap.width, pixmap.height), pixmap.samples)
    document.close()
    return image


def crop_flat_edges(image: Image.Image) -> Image.Image:
    pixels = np.array(image.convert("RGBA"))

    def crop_edge(data: np.ndarray, from_start: bool) -> np.ndarray:
        if data.shape[0] < 20:
            return data

        index = 0 if from_start else -1
        row = data[index]
        if row[:, 3].mean() < 220 or row[:, :3].std() > 10:
            return data

        color = row[:, :3].mean(axis=0)
        limit = int(data.shape[0] * 0.45)
        cut = 0
        while cut < limit:
            current = data[cut if from_start else -1 - cut]
            if current[:, 3].mean() < 220 or current[:, :3].std() > 10:
                break
            if np.abs(current[:, :3].mean(axis=0) - color).max() > 16:
                break
            cut += 1

        if cut < 8:
            return data

        return data[cut:] if from_start else data[:-cut]

    pixels = crop_edge(pixels, True)
    pixels = crop_edge(pixels, False)
    return Image.fromarray(pixels, "RGBA")


def trim(image: Image.Image) -> Image.Image:
    image = image.convert("RGBA")
    background = Image.new("RGB", image.size, (255, 255, 255))
    difference = ImageChops.difference(image.convert("RGB"), background)
    content = difference.convert("L").point(lambda pixel: 255 if pixel > 14 else 0)
    mask = ImageChops.multiply(content, image.getchannel("A"))
    box = mask.getbbox()
    if box:
        image = image.crop(box)
    return image


def limit_size(image: Image.Image, max_edge: int = 900) -> Image.Image:
    image.thumbnail((max_edge, max_edge), Image.Resampling.LANCZOS)
    return image


for folder_name, tier in TIERS.items():
    source = ROOT / folder_name
    target = OUT / tier
    target.mkdir(parents=True, exist_ok=True)
    files = sorted([path for path in source.iterdir() if path.is_file()], key=sort_key)
    for index, path in enumerate(files, start=1):
        if path.suffix.lower() in {".pdf", ".ai"}:
            image = render_pdf(path)
        elif path.suffix.lower() in {".tif", ".tiff"}:
            image = open_tiff(path)
        else:
            image = Image.open(path)
        image = crop_flat_edges(limit_size(trim(image)))
        name = display_name(path)
        destination = target / f"{index:02d}-{name}.png"
        exported = Image.new(image.mode, image.size)
        exported.paste(image)
        exported.save(destination, "PNG", optimize=True)
        print(f"{tier}: {destination.name} {image.size}")
