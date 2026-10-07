<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Xác nhận đăng ký tham dự</title>
</head>
<body style="margin:0;padding:24px;background:#f4f7f5;font-family:Arial,sans-serif;color:#1e293b;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;margin:0 auto;background:#ffffff;border:1px solid #d5e8d8;border-radius:16px;">
        <tr>
            <td style="padding:28px 32px;background:#1b6b32;color:#ffffff;">
                <div style="font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:#f6e7b2;">Hội nghị Khoa học Quốc tế</div>
                <div style="margin-top:8px;font-size:22px;font-weight:700;">Bệnh viện Hữu nghị Việt Đức 2026</div>
            </td>
        </tr>
        <tr>
            <td style="padding:32px;">
                <p style="margin:0 0 16px;">Kính gửi {{ $registration->full_name }},</p>
                <p style="margin:0 0 16px;">Ban Tổ chức đã ghi nhận đăng ký tham dự của Quý đại biểu. Vui lòng lưu mã tham dự bên dưới để check-in tại Hội nghị.</p>
                <div style="margin:24px 0;padding:20px;border:1px solid #b7d7bc;border-radius:12px;background:#f3f9f4;text-align:center;">
                    <div style="font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#1b6b32;">Mã tham dự</div>
                    <div style="margin-top:8px;font-size:28px;font-weight:700;letter-spacing:0.06em;color:#145428;">{{ $registration->delegate_id }}</div>
                </div>
                <p style="margin:0 0 8px;"><strong>Thời gian:</strong> Thứ Năm, 19/11/2026</p>
                <p style="margin:0 0 8px;"><strong>Địa điểm:</strong> Trung tâm Hội nghị Quốc gia, Hà Nội</p>
                <p style="margin:0 0 16px;"><strong>Tiệc tối:</strong> {{ $registration->attend_dinner ? 'Có tham dự' : 'Không tham dự' }}</p>
                <p style="margin:0;">Mọi thắc mắc xin liên hệ Ban Tổ chức qua email eventvietduc@vduh.org.</p>
            </td>
        </tr>
    </table>
</body>
</html>
