@extends('layouts.conference')

@section('title', __('conference.nav.program'))

@section('content')
@php
$locale = $locale ?? app()->getLocale();

$conferenceScheduleVi = [
    ['07h30 – 07h50', 'Tiếp đón đại biểu', 'Ban Tổ chức'],
    ['07h50 – 08h00', 'Phát biểu Khai mạc', 'PGS. TS. Dương Đức Hùng — Giám đốc Bệnh viện Hữu nghị Việt Đức'],
    ['08h30 – 10h00', 'Phiên Tổng quan', 'Toàn bộ đại biểu'],
    ['10h00 – 10h15', 'Tiệc trà', null],
    ['10h15 – 11h30', 'Phiên 2', 'Toàn bộ đại biểu'],
    ['11h30 – 13h00', 'Ăn trưa', null],
    ['13h00 – 14h25', 'Phiên 3', 'Toàn bộ đại biểu'],
    ['14h25 – 14h40', 'Tiệc trà', null],
    ['14h40 – 16h15', 'Phiên 4', 'Toàn bộ đại biểu'],
    ['17h00 – 20h00', 'Tiệc tối', null],
];

$conferenceScheduleEn = [
    ['07:30 – 07:50', 'Delegate Reception & Welcome', 'Organizing Committee'],
    ['07:50 – 08:00', 'Opening Remarks', 'Assoc. Prof. Duong Duc Hung, MD, PhD — Director of VDUH'],
    ['08:30 – 10:00', 'Plenary Session', 'All Delegates'],
    ['10:00 – 10:15', 'Tea Break', null],
    ['10:15 – 11:30', 'Session 2', 'All Delegates'],
    ['11:30 – 13:00', 'Lunch Break', null],
    ['13:00 – 14:25', 'Session 3', 'All Delegates'],
    ['14:25 – 14:40', 'Tea Break', null],
    ['14:40 – 16:15', 'Session 4', 'All Delegates'],
    ['17:00 – 20:00', 'Gala Dinner', null],
];

$conferenceSchedule = $locale === 'en' ? $conferenceScheduleEn : $conferenceScheduleVi;

$hallScheduleVi = [
    ['Phòng Khánh tiết - Tầng 1', 'Phiên Tổng quan', 'Chấn thương chỉnh hình', 'Chấn thương chỉnh hình', 'Chấn thương chỉnh hình'],
    ['Phòng 101 - Tầng 1', '—', 'Cột sống', 'Nam học – Tiết niệu', 'Nam học – Tiết niệu'],
    ['Phòng 188 - Tầng 1', '—', 'Nội – Cận lâm sàng', 'Gây mê hồi sức', 'Gây mê hồi sức'],
    ['Phòng 220 - Tầng 2', '—', 'Ghép tạng', 'Ghép tạng', 'Ghép tạng'],
    ['Phòng 218 - Tầng 2', '—', 'Ghép tạng', 'Phẫu thuật Thần kinh', 'Phẫu thuật Thần kinh'],
    ['Phòng 216 - Tầng 2', '—', 'Ghép tạng', 'Gan mật – Tụy', 'Gan mật – Tụy'],
    ['Phòng 210 - Tầng 2', '—', 'Dược lâm sàng', 'Tiêu hóa – Bệnh lý sàn chậu', 'Tiêu hóa – Bệnh lý sàn chậu'],
    ['Phòng 207 - Tầng 2', '—', 'Điều dưỡng', 'Điều dưỡng', 'Điều dưỡng'],
    ['Phòng 219 - Tầng 2', '—', 'Tim mạch – Lồng ngực', 'Tim mạch – Lồng ngực', 'Tim mạch – Lồng ngực'],
    ['Phòng 217 - Tầng 2', '—', 'Chẩn đoán hình ảnh', 'Phẫu thuật Tạo hình – Thẩm mỹ', 'Phẫu thuật Tạo hình – Thẩm mỹ'],
];

$hallScheduleEn = [
    ['Grand Reception Hall - 1st Floor', 'Plenary Session', 'Orthopaedics & Traumatology', 'Orthopaedics & Traumatology', 'Orthopaedics & Traumatology'],
    ['Room 101 - 1st Floor', '—', 'Spine Surgery', 'Andrology & Urology', 'Andrology & Urology'],
    ['Room 188 - 1st Floor', '—', 'Internal Medicine & Paraclinical', 'Anesthesiology & Resuscitation', 'Anesthesiology & Resuscitation'],
    ['Room 220 - 2nd Floor', '—', 'Organ Transplantation', 'Organ Transplantation', 'Organ Transplantation'],
    ['Room 218 - 2nd Floor', '—', 'Organ Transplantation', 'Neurosurgery', 'Neurosurgery'],
    ['Room 216 - 2nd Floor', '—', 'Organ Transplantation', 'Hepatobiliary & Pancreatic', 'Hepatobiliary & Pancreatic'],
    ['Room 210 - 2nd Floor', '—', 'Clinical Pharmacy', 'Gastroenterology & Pelvic Floor', 'Gastroenterology & Pelvic Floor'],
    ['Room 207 - 2nd Floor', '—', 'Surgical Nursing', 'Surgical Nursing', 'Surgical Nursing'],
    ['Room 219 - 2nd Floor', '—', 'Cardiovascular & Thoracic Surgery', 'Cardiovascular & Thoracic Surgery', 'Cardiovascular & Thoracic Surgery'],
    ['Room 217 - 2nd Floor', '—', 'Diagnostic Imaging', 'Plastic & Aesthetic Surgery', 'Plastic & Aesthetic Surgery'],
];

$hallSchedule = $locale === 'en' ? $hallScheduleEn : $hallScheduleVi;

$hallsData = [
    [
        'id' => 'khanh-tiet',
        'name' => $locale === 'en' ? 'Grand Reception Hall - 1st Floor' : 'Phòng Khánh tiết - Tầng 1',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 1,
                'name' => 'PHIÊN TỔNG QUAN',
                'chairs' => 'PGS.TS. Dương Đức Hùng, TS.BS. Nguyễn Ngô Quang, GS.TS. Đỗ Kim Sơn, PGS.TS. Nguyễn Tiến Quyết, GS.TS. Trần Bình Giang',
                'time' => '08h30 – 10h00',
                'items' => [
                    [
                        'time' => '08h30 – 08h50',
                        'title' => 'Bệnh viện Hữu nghị Việt Đức: 120 năm hình thành và phát triển',
                        'speaker' => 'PGS.TS. Dương Đức Hùng',
                        'org' => 'Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '08h50 – 09h10',
                        'title' => 'Minimally invasive living donor liver transplantation',
                        'speaker' => 'Prof. Kwang – Woong Lee',
                        'org' => 'Department of Hepatobiliary and Pancreatic Surgery, Seoul National University Hospital',
                    ],
                    [
                        'time' => '09h10 – 09h30',
                        'title' => 'Pancreas-Kidney Transplantation: experience sharing',
                        'speaker' => 'Prof. Sung Shin',
                        'org' => 'Division of Kidney and Pancreas Transplantation, Asan Medical Center, Seoul',
                    ],
                    [
                        'time' => '09h30 – 09h50',
                        'title' => 'Uterine transplantation: From the first successful case to the present day',
                        'speaker' => 'Prof. Dr Ömer Özkan',
                        'org' => 'Phẫu thuật Tạo hình, Tái tạo và Thẩm mỹ',
                    ],
                    [
                        'time' => '09h50 – 10h00',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '10h00 – 10h15',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: CHẤN THƯƠNG CHỈNH HÌNH',
                'chairs' => 'PGS.TS. Nguyễn Mạnh Khánh, PGS.TS. Đào Xuân Thành, TS.BS. Lê Mạnh Sơn',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Kết quả bước đầu phẫu thuật chỉnh trục vẹo trong khuỷu sử dụng trợ cụ cá thể hóa tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Nguyễn Mộc Sơn',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Đánh giá kết quả sau 2 năm phẫu thuật nội soi khớp cổ chân điều trị tổn thương sụn xương sên (OLT)',
                        'speaker' => 'ThS.BS. Đỗ Vũ Anh',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Rách rễ sụn chêm: Nhìn lại y văn, kỹ thuật và kinh nghiệm xử trí',
                        'speaker' => 'ThS.BS. Đỗ Vũ Anh',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Đánh giá kết quả điều trị rách rộng chóp xoay tăng cường fibrin giàu tiểu cầu trong mổ tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Đỗ Văn Hải',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'Đánh giá kết quả phẫu thuật sửa chữa dây chằng sên mác trước bằng kỹ thuật Broström cải tiến có gia cố InternalBrace kèm nội soi khớp cổ chân',
                        'speaker' => 'ThS.BS. Nguyễn Huy Thiệp',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Xử trí khuyết xương ổ cối trong thay lại khớp háng nhân tạo: Báo cáo chùm ca bệnh',
                        'speaker' => 'ThS.BS. Đặng Văn Long',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h30',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h30 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: CHẤN THƯƠNG CHỈNH HÌNH',
                'chairs' => 'PGS.TS. Đặng Hoàng Anh, BSCKII. Đoàn Việt Quân, TS. Nguyễn Văn Học',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Điều trị hẹp khoang dưới mỏm quạ kèm tổn thương gân dưới vai: Báo cáo ca lâm sàng',
                        'speaker' => 'ThS.BS. Cao Đình Bằng',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Phẫu thuật nội soi tái tạo dây chằng chéo trước bằng phương pháp all-inside sử dụng mảnh ghép gân hamstring kết hợp màng sinh học Meso',
                        'speaker' => 'ThS.BS. Trần Quốc Tuấn',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Ứng dụng trí tuệ nhân tạo hỗ trợ chẩn đoán loãng xương ở bệnh nhân gãy đầu trên xương đùi từ 70 tuổi trở lên tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Lê Xuân Hoàng',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Phẫu thuật sớm ở bệnh nhân gãy xương chi dưới có thuyên tắc huyết khối tĩnh mạch',
                        'speaker' => 'ThS.BS. Đặng Văn Long',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Tổng kết 15 năm nghiên cứu ghép mô gân, xương đồng loài tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Trần Hoàng Tùng',
                        'org' => 'Khoa Phẫu thuật Chi dưới, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Kết quả bước đầu thay khớp gối trục động học tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BSCKII. Nguyễn Tiến Sơn',
                        'org' => 'Khoa Phẫu thuật Chi dưới, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Đánh giá kết quả điều trị thay khớp háng toàn phần không xi măng trên bệnh nhân hoại tử vô khuẩn chỏm xương đùi bằng đường mổ SuperPATH',
                        'speaker' => 'BSCKII. Đoàn Việt Quân',
                        'org' => 'Khoa Phẫu thuật Chi dưới, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h10 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: CHẤN THƯƠNG CHỈNH HÌNH',
                'chairs' => 'TS.BS. Nguyễn Việt Nam, BSCKII. Nguyễn Tiến Sơn, PGS.TS. Dương Đình Toàn',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Tiến bộ trong điều trị gãy xương gót: Vai trò của đường mổ xoang Tarsi và các ca lâm sàng điển hình',
                        'speaker' => 'BS. Trần Mạnh Hùng',
                        'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Những tiến bộ trong điều trị nhiễm trùng khớp nhân tạo: Từ lý thuyết đến thực hành lâm sàng',
                        'speaker' => 'BS. Ngô Đức Quang',
                        'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Kết quả bước đầu điều trị gãy ổ cối bằng đường mổ Stoppa cải biên: Kinh nghiệm từ loạt ca lâm sàng',
                        'speaker' => 'BS. Nguyễn Văn Phan',
                        'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Đứt lại mảnh ghép sau tái tạo dây chằng chéo trước khớp gối: Nguyên nhân và giải pháp',
                        'speaker' => 'PGS.TS. Dương Đình Toàn',
                        'org' => 'Khoa Khám xương và Điều trị ngoại trú, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Đánh giá kết quả phẫu thuật điều trị gãy Monteggia đến muộn tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Lê Xuân Hoàng',
                        'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Phục hồi chức năng từ xa cho người bệnh sau phẫu thuật nội soi điều trị rách chóp xoay khớp vai',
                        'speaker' => 'BS. Phạm Đình Phương',
                        'org' => 'Khoa Phục hồi chức năng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h50',
                        'title' => 'Báo cáo kết quả bước đầu phẫu thuật giải phóng đường hầm ống cổ tay ít xâm lấn dưới hướng dẫn của siêu âm tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Nguyễn Hoàng Long',
                        'org' => 'Trung tâm Khám bệnh - Cấp cứu và Điều trị ban ngày, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h50 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Chiến lược xử trí trật khớp vai lần đầu',
                'speaker' => 'TS.BS. Nguyễn Văn Học',
                'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Đặc điểm giải phẫu, cơ sinh học gân mác dài, ứng dụng trong tái tạo dây chằng chéo khớp gối',
                'speaker' => 'TS.BS. Nguyễn Hoàng Quân',
                'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Kết quả nội soi điều trị bong điểm bám dây chằng chéo sau',
                'speaker' => 'ThS.BS. Cao Đình Bằng, ThS.BS. Nguyễn Trung Kiên',
                'org' => 'Khoa Phẫu thuật Chi trên và Y học thể thao, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '4',
                'title' => 'Tổng kết phẫu thuật ghép gân Achilles đến muộn tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'TS.BS. Trần Hoàng Tùng, BS. Nguyễn Trung Kiên',
                'org' => 'Khoa Phẫu thuật Chi dưới, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '5',
                'title' => 'Thay khớp gối gióng trục động học: Kết quả bước đầu và chia sẻ kinh nghiệm từ loạt ca lâm sàng',
                'speaker' => 'TS.BS. Lê Mạnh Sơn, BS. Đoàn Lê Vinh',
                'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '6',
                'title' => 'Phẫu thuật hai giai đoạn sử dụng xi măng kháng sinh điều trị nhiễm trùng sau thay khớp',
                'speaker' => 'BS. Đoàn Lê Vinh',
                'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '7',
                'title' => 'Ứng dụng phân loại ba cột trong điều trị gãy mâm chày tổn thương cột sau',
                'speaker' => 'TS.BS. Lê Mạnh Sơn, BS. Nguyễn Văn Phan, BS. Nguyễn Sỹ Tùng',
                'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '8',
                'title' => 'Kết quả phẫu thuật nội soi tái tạo dây chằng chéo trước bảo tồn di tích tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'TS.BS. Lê Mạnh Sơn, BS. Bùi Nguyên Long',
                'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '9',
                'title' => 'Ứng dụng đinh PFNA trong điều trị gãy đầu trên xương đùi ở người cao tuổi: Các điểm kỹ thuật quan trọng và kinh nghiệm lâm sàng',
                'speaker' => 'BS. Nguyễn Văn Phan, BS. Phạm Vũ Anh Quang',
                'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '10',
                'title' => 'Chiến lược điều trị gãy mắt cá sau: Từ chỉ định kết hợp xương đến kết quả lâm sàng',
                'speaker' => 'TS.BS. Lê Mạnh Sơn, BS. Nguyễn Văn Phan, BS. Đỗ Đức Mạnh',
                'org' => 'Khoa Phẫu thuật Chấn thương Chung, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-1',
        'name' => $locale === 'en' ? 'Room 101 - 1st Floor' : 'Phòng 101 - Tầng 1',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: CỘT SỐNG',
                'chairs' => 'PGS.TS. Nguyễn Văn Thạch, PGS.TS. Đinh Ngọc Sơn, TS.BS. Nguyễn Hoàng Long',
                'time' => '10h15 – 11h40',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Ứng dụng robot, O-arm và hệ thống định vị trong phẫu thuật bệnh lý cột sống',
                        'speaker' => 'PGS.TS. Đinh Ngọc Sơn',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Ứng dụng phẫu thuật nội soi hai cổng trong điều trị bệnh lý cột sống',
                        'speaker' => 'PGS.TS. Đinh Ngọc Sơn',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Kết quả phẫu thuật hàn xương liên thân đốt đường bên điều trị bệnh lý cột sống thắt lưng',
                        'speaker' => 'TS.BSCKII. Vũ Văn Cường',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Kết quả phẫu thuật thay đĩa đệm nhân tạo cột sống thắt lưng',
                        'speaker' => 'PGS.TS. Đinh Ngọc Sơn',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'Một số chỉ số giải phẫu ứng dụng trong phẫu thuật bắt vít qua cuống cột sống',
                        'speaker' => 'TS.BS. Nguyễn Hoàng Long',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'So sánh kết quả phẫu thuật nội soi gian lam và mổ mở lấy thoát vị đĩa đệm tầng L5 -S1 tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Đỗ Mạnh Hùng',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h25',
                        'title' => 'Thuận lợi và khó khăn của phẫu thuật nội soi qua đường mỏm khớp trên (Trans -SAP)',
                        'speaker' => 'ThS.BS. Hoàng Hữu Đức',
                        'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h25 – 11h40',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h40 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: NAM HỌC – TIẾT NIỆU',
                'chairs' => 'PGS.TS. Đỗ Trường Thành, PGS.TS. Nguyễn Quang, TS.BS. Đỗ Ngọc Sơn',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Kết quả điều trị phẫu thuật và chiến lược can thiệp ở người bệnh u thận kèm huyết khối tĩnh mạch: Kinh nghiệm tại Bệnh viện Hữu nghị Việt Đức giai đoạn 2020 – 2026',
                        'speaker' => 'PGS.TS. Đỗ Trường Thành',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Đánh giá kết quả điều trị bệnh lún dương vật ở trẻ em',
                        'speaker' => 'ThS.BS. Đặng Thị Huyền Trang',
                        'org' => 'Phẫu thuật Nhi và Trẻ sơ sinh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Đánh giá kết quả nội soi ổ bụng cắt túi tinh điều trị xuất tinh máu do chảy máu túi tinh tại Trung tâm Nam học, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Trịnh Hoàng Giang',
                        'org' => 'Trung tâm Nam học, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Đánh giá kết quả sớm sau phẫu thuật nội soi nạo vét hạch trong điều trị ung thư dương vật tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Nguyễn Hữu Thảo',
                        'org' => 'Trung tâm Nam học, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Đánh giá chất lượng cuộc sống theo thang điểm SLQQ của người bệnh phẫu thuật tạo hình dương vật bằng mảnh ghép tĩnh mạch chủ đồng loài điều trị bệnh xơ cứng vật hang tại Trung tâm Nam học, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Bùi Văn Quang',
                        'org' => 'Trung tâm Nam học, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Kết quả tán sỏi thận qua da đường hầm nhỏ tại Bệnh viện Hữu nghị Việt Đức giai đoạn 2024 – 2026',
                        'speaker' => 'BSCKII. Nguyễn Văn Linh',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Kết quả bóc nhân phì đại lành tính tuyến tiền liệt bằng laser Holmium tại Bệnh viện Hữu nghị Việt Đức giai đoạn 2024 – 2026',
                        'speaker' => 'PGS.TS. Đỗ Trường Thành',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h10 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: NAM HỌC – TIẾT NIỆU',
                'chairs' => 'PGS.TS. Hoàng Long, TS.BS. Trịnh Hoàng Giang, TS.BS. Nguyễn Đức Minh',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Phẫu thuật nội soi sau phúc mạc cắt thận bán phần điều trị u thận thể endophytic hoàn toàn: Báo cáo bốn trường hợp',
                        'speaker' => 'TS.BS. Nguyễn Huy Hoàng',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Áp dụng kỹ thuật “Polar Flip” trong phẫu thuật nội soi sau phúc mạc cắt thận bán phần đối với khối u rốn thận mặt trước trong',
                        'speaker' => 'TS.BS. Nguyễn Huy Hoàng',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Kết quả gần và chiến lược xử trí trong phẫu thuật nội soi cắt u bảo tồn thận đối với khối u thận có mức độ phức tạp trung bình đến cao theo thang điểm RENAL tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Nguyễn Đức Minh',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Tổng kết kết quả điều trị ung thư thận bằng phẫu thuật nội soi cắt U bảo tồn thận qua đường sau phúc mạc, trong 5 năm tại bệnh viện Việt Đức, 2020-2025',
                        'speaker' => 'TS.BS. Đỗ Ngọc Sơn',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Các phương pháp tiếp cận phẫu thuật điều trị hẹp khúc nối bể thận - niệu quản ở trẻ em',
                        'speaker' => 'PGS.TS. Nguyễn Việt Hoa',
                        'org' => 'Phẫu thuật Nhi và Trẻ sơ sinh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Đánh giá tỷ lệ sống sau mổ và các yếu tố ảnh hưởng ở người bệnh được phẫu thuật tạo hình Abol-Enein điều trị ung thư bàng quang tại Khoa Điều trị theo yêu cầu, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Trần Chí Thanh',
                        'org' => 'Khoa Điều trị theo yêu cầu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h50',
                        'title' => 'Chẩn đoán rối loạn phát triển giới tính tại Bệnh viện Hữu nghị Việt Đức: Thuận lợi và khó khăn',
                        'speaker' => 'TS.BS. Trần Thị Ngọc Anh',
                        'org' => 'Khoa Sinh hóa - Huyết học - Ngân hàng Mô, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h50 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Đánh giá kết quả gần của phẫu thuật cắt toàn bộ tuyến tiền liệt áp dụng kỹ thuật bảo tồn tối đa chiều dài niệu đạo chức năng và cổ bàng quang trong điều trị ung thư tuyến tiền liệt: Thách thức cân bằng giữa chức năng tiểu tiện và kết quả ung thư',
                'speaker' => 'TS.BS. Đỗ Ngọc Sơn, TS.BS. Nguyễn Huy Hoàng',
                'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Tán sỏi thận qua da đường hầm nhỏ dưới hướng dẫn siêu âm cho người bệnh sỏi san hô thận',
                'speaker' => 'BSCKII. Võ Văn Minh, TS.BS. Nguyễn Huy Hoàng',
                'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Kết quả và một số yếu tố liên quan đến phẫu thuật nội soi lối sau đơn tầng điều trị thoát vị đĩa đệm cột sống cổ',
                'speaker' => 'ThS.BS. Đinh Thế Hưng',
                'org' => 'Trung tâm Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-2',
        'name' => $locale === 'en' ? 'Room 188 - 1st Floor' : 'Phòng 188 - Tầng 1',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: NỘI – CẬN LÂM SÀNG',
                'chairs' => 'PGS.TS. Hà Phan Hải An, TS. Trần Thị Hằng, TS. Đỗ Thế Hùng',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Bước đầu đánh giá hiệu quả của quản trị tinh gọn tới quy trình khám bệnh ngoại trú tại phòng khám Tim mạch Lồng ngực Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS. Nguyễn Xuân Vinh',
                        'org' => 'Phòng Quản lý chất lượng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Khảo sát tình hình truyền máu và chế phẩm máu trên bệnh nhân ghép tạng tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BS. Nguyễn Trang Vân',
                        'org' => 'Trung tâm Truyền máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Nghiên cứu một số đặc điểm của bệnh nhân nhiễm HIV tại Bệnh viện Hữu nghị Việt Đức giai đoạn 2023 - 2024',
                        'speaker' => 'BS. Phạm Thị Hồng Trang',
                        'org' => 'Trung tâm Truyền máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Nghiên cứu đặc điểm kháng thể kháng HLA đặc hiệu với người cho của bệnh nhân suy thận mạn được lọc huyết tương trước ghép thận tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Lưu Thị Tố Uyên',
                        'org' => 'Trung tâm Truyền máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'Kết quả điều trị bướu nhân tuyến giáp lành tính bằng phương pháp đốt vi sóng tại Bệnh viện Đa khoa Nông nghiệp',
                        'speaker' => 'BSCKII. Hà Thị Kim Thanh',
                        'org' => 'Khoa Nội Tim mạch – Nội tiết, Bệnh viện Đa khoa Nông Nghiệp (Bệnh viện Hữu nghị Việt Đức)',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Giá trị của thang điểm PRESS trong phân loại mức độ nặng của nhiễm khuẩn hô hấp dưới cấp tính ở trẻ dưới 5 tuổi tại Bệnh viện Đa khoa Nông nghiệp',
                        'speaker' => 'ThS.BS. Lê Thị Việt Hà',
                        'org' => 'Khoa Nhi, Bệnh viện Đa khoa Nông Nghiệp (Bệnh viện Hữu nghị Việt Đức)',
                    ],
                    [
                        'time' => '11h15 – 11h30',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h30 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: GÂY MÊ HỒI SỨC',
                'chairs' => 'GS.TS. Nguyễn Quốc Kính, TS.BS. Nguyễn Thị Thúy Ngân, TS.BS. Đỗ Trung Dũng',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Implementation of ERAS in Taiwan: challenges and opportunities',
                        'speaker' => 'Prof. Shu-Lin Guo',
                        'org' => 'Department of Anesthesiology, Chia-Yi Christian Hospital, Taiwan',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Điều trị rối loạn đông máu sau phẫu thuật ghép gan: Cập nhật các phác đồ chống đông sau ghép',
                        'speaker' => 'ThS.BS. Nguyễn Thị Thủy',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Điều trị huyết động theo đích ở người bệnh ghép thận từ người hiến chết não: Nghiên cứu tiến cứu ghép cặp thận',
                        'speaker' => 'ThS.BS. Vũ Văn Trịnh',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Quản lý đường thở trong phẫu thuật khối u cổ khổng lồ gây hẹp khí quản nặng: Vai trò của độ đàn hồi thành khí quản và dự phòng ECMO',
                        'speaker' => 'BS. Hoàng Thị Hoài Thu',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Cập nhật cấp cứu ngừng tuần hoàn',
                        'speaker' => 'BS. Nguyễn Hoàng Hải',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Gây mê trong ghép phổi: Kinh nghiệm bước đầu tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Nguyễn Thị Thuý Ngân',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Gây mê bằng mặt nạ thanh quản thế hệ 2 có camera cho người bệnh phẫu thuật đường tiêu hóa trên tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Đào Thị Kim Dung',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h10 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: GÂY MÊ HỒI SỨC',
                'chairs' => 'PGS.TS. Lưu Quang Thùy, PGS.TS. Trịnh Văn Đồng, TS.BS. Đào Thị Kim Dung',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Gây mê cho phẫu thuật khớp háng ở người cao tuổi',
                        'speaker' => 'BS. Nguyễn Văn Hoan',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Sảng trong gây mê hồi sức',
                        'speaker' => 'TS.BS. Nguyễn Bá Tuân',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Mở khí quản qua da trong cấp cứu đường thở khó ở người bệnh chấn thương hàm mặt: Báo cáo các ca lâm sàng tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BS. Đặng Hải Sơn',
                        'org' => 'Trung tâm Khám bệnh - Cấp cứu và Điều trị ban ngày, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Ứng dụng mở khí quản nhanh qua da bằng dụng cụ PercuTwist tại Khoa Hồi sức tích cực',
                        'speaker' => 'BS. Đoàn Mạnh Tuấn',
                        'org' => 'Khoa Hồi sức tích cực, Bệnh viện Đa khoa Nông nghiệp (Bệnh viện Hữu nghị Việt Đức)',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Tối ưu hóa “giờ vàng” đột quỵ: Cứu sống nhu mô não cấp',
                        'speaker' => 'ThS.BS. Vũ Ngọc Linh',
                        'org' => 'Khoa Nội Tim mạch – Nội tiết, Bệnh viện Đa khoa Nông nghiệp (Bệnh viện Hữu nghị Việt Đức)',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Điều trị giải mẫn cảm trước ghép thận cho người bệnh có nguy cơ miễn dịch cao',
                        'speaker' => 'ThS.BS. Man Thị Thu Hương',
                        'org' => 'Khoa Thận – Lọc máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h50',
                        'title' => 'Đánh giá kết quả điều trị sẹo hẹp khí quản bằng nội soi nong hẹp tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BS. Nguyễn Văn Chung',
                        'org' => 'Trung tâm Khám bệnh - Cấp cứu và Điều trị ban ngày, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h50 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
        ]
    ],
    [
        'id' => 'hoi-truong-3',
        'name' => $locale === 'en' ? 'Room 220 - 2nd Floor' : 'Phòng 220 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: GHÉP TẠNG (GHÉP GAN)',
                'chairs' => 'Prof. Kwang Woong Lee, PGS.TS. Nguyễn Tiến Quyết, PGS.TS. Nguyễn Quang Nghĩa',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Tailored outflow reconstruction in DDLT: How to choose the appropriate approach?',
                        'speaker' => 'Prof. Kwang – Woong Lee',
                        'org' => 'Department of Hepatobiliary and Pancreatic Surgery, Seoul National University Hospital',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Chiến lược xử trí tổn thương mạch máu khó trong ghép gan: Bí quyết lâm sàng và lưu ý kỹ thuật',
                        'speaker' => 'TS.BS. Ninh Việt Khải',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Transplantation hépatique pour métastases hépatiques colorectales non résécables : résultats d’une expérience monocentrique selon le protocole TRANSME',
                        'speaker' => 'Dr Thanh Tu ALBERT',
                        'org' => 'Hôpital Pitié Salpêtrière 75013 Paris',
                    ],
                    [
                        'time' => '10h45 – 11h00',
                        'title' => 'Chia gan để ghép: Kinh nghiệm triển khai và phối hợp đa chuyên khoa',
                        'speaker' => 'TS.BS. Ninh Việt Khải, ThS.BS. Hoàng Tuấn',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h00 – 11h15',
                        'title' => 'Ghép gan Domino: Trường hợp đầu tiên tại Việt Nam',
                        'speaker' => 'PGS.TS. Nguyễn Quang Nghĩa',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h30',
                        'title' => 'Tối ưu hoá ức chế miễn dịch sau ghép gan: từ hướng dẫn điều trị đến thực hành lâm sàng',
                        'speaker' => 'ThS.BS Hoàng Tuấn',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h30 – 11h45',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h45 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: GHÉP TẠNG (GHÉP THẬN)',
                'chairs' => 'Prof. Sung Shin, PGS.TS. Lê Nguyên Vũ, TS.BS. Nguyễn Việt Hải, TS.BS. Đỗ Ngọc Sơn',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h15',
                        'title' => 'Đánh giá kết quả phẫu thuật ghép thận từ người cho chết não tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'PGS.TS. Lê Nguyên Vũ',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h15 – 13h30',
                        'title' => 'Đặc điểm lâm sàng, nguyên nhân và kết quả điều trị tăng men gan ở người bệnh sau ghép thận tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BS. Nguyễn Thu Trang',
                        'org' => 'Khoa Thận lọc máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h45',
                        'title' => 'First Robotic KTx in Asia for Polycystic Kidney Disease patient',
                        'speaker' => 'Prof. Sung Shin',
                        'org' => 'Division of Kidney and Pancreas Transplantation, Asan Medical Center, Seoul',
                    ],
                    [
                        'time' => '13h45 – 14h05',
                        'title' => 'Ghép thận bằng đường mổ nhỏ',
                        'speaker' => 'ThS.BS. Trần Đình Dũng',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h05 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea Break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: GHÉP TẠNG (GHÉP THẬN)',
                'chairs' => 'PGS.TS. Lê Việt Thắng, PGS.TS. Hà Phan Hải An, TS.BS. Nguyễn Thế Cường, TS.BS. Huỳnh Ngọc Phương Thảo',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h55',
                        'title' => 'Kết quả điều trị thay thế thận cho bệnh nhân bệnh thận giai đoạn cuối tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Nguyễn Thế Cường',
                        'org' => 'Khoa Thận lọc máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h55 – 15h10',
                        'title' => 'Trì hoãn chức năng thận ghép: chẩn đoán và xử trí',
                        'speaker' => 'PGS.TS. Lê Việt Thắng',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Quân Y 103',
                    ],
                    [
                        'time' => '15h10 – 15h25',
                        'title' => 'Ghép thận từ người hiến chết não có tổn thương thận cấp tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BS. Hoàng Thị Điểm',
                        'org' => 'Khoa Thận lọc máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h25 – 15h40',
                        'title' => 'Lựa chọn phác đồ dẫn nhập trong ghép thận',
                        'speaker' => 'BS. Huỳnh Ngọc Phương Thảo',
                        'org' => 'Khoa Nội thận – Thận nhân tạo, Bệnh viện Đại học Y Dược TP. Hồ Chí Minh',
                    ],
                    [
                        'time' => '15h40 – 15h55',
                        'title' => 'Vai trò của r-ATG trong điều trị dẫn nhập cho ghép thận tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Nguyễn Thế Cường',
                        'org' => 'Khoa Thận lọc máu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h55 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Nhiễm BK virus ở bệnh nhân sau ghép thận',
                'speaker' => 'ThS.BS. Phạm Quang Đức',
                'org' => 'Khoa Thận lọc máu, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Mức độ tuân thủ thuốc ở người bệnh sau ghép thận và một số yếu tố liên quan tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'BS. Nguyễn Thị Thu Hương',
                'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Đánh giá kết quả sử dụng dẫn nhập bằng ATG ở bệnh nhân ghép thận tại Trung tâm Ghép tạng',
                'speaker' => 'ThS.BS. Trần Minh Tuấn',
                'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '4',
                'title' => 'Đánh giá kết quả ghép thận cho người nhận có bàng quang bé điều trị tại khoa Thận lọc máu',
                'speaker' => 'BS. Hoàng Thị Điểm',
                'org' => 'Khoa Thận lọc máu, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '5',
                'title' => 'Kết quả ghép thận đảo cực tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Hoàng Tuấn',
                'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '6',
                'title' => 'Kinh nghiệm ghép thận từ người hiến có nhiều động mạch',
                'speaker' => 'TS.BS. Ninh Việt Khải, ThS.BS. Nguyễn Đức Trung',
                'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '7',
                'title' => 'Phục hồi chức năng từ xa cho người bệnh sau ghép thận',
                'speaker' => 'PGS.TS. Nguyễn Thị Kim Liên',
                'org' => 'Khoa Phục hồi chức năng, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-4',
        'name' => $locale === 'en' ? 'Room 218 - 2nd Floor' : 'Phòng 218 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: GHÉP TẠNG (GHÉP TIM)',
                'chairs' => 'PGS.TS. Dương Đức Hùng, GS.TS. Nguyễn Hoàng Định, TS.BS. Ngô Vi Hải, PGS.TS. Phùng Duy Hồng Sơn',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Ghép tim: Ai nên được xem xét và khi nào?',
                        'speaker' => 'ThS.BS. Đinh Thị Trang',
                        'org' => 'Khoa Nội, Can thiệp Tim mạch - Hô hấp, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Suy mảnh ghép tiên phát trong ghép tim: nguyên nhân, chẩn đoán, xử trí và kinh nghiệm tại Bệnh viện Trung ương Quân đội 108',
                        'speaker' => 'TS.BS. Ngô Vi Hải',
                        'org' => 'Khoa Phẫu thuật Tim mạch, Bệnh viện Trung ương Quân đội 108',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Kinh nghiệm triển khai ghép tim tại Bệnh viện Đại học Y Dược TP. Hồ Chí Minh',
                        'speaker' => 'GS.TS. Nguyễn Hoàng Định',
                        'org' => 'Bệnh viện Đại học Y Dược TP. Hồ Chí Minh',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Đánh giá chức năng thất phải bằng siêu âm tim ở bệnh nhân sau ghép tim trên 3 năm tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Khổng Tiến Bình',
                        'org' => 'Khoa Nội, Can thiệp Tim mạch - Hô hấp, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => '15 năm ghép tim tại Bệnh viện Trung ương Huế',
                        'speaker' => 'TS.BS. Bùi Đức An Vinh',
                        'org' => 'Khoa Ngoại Lồng ngực – Tim mạch, Bệnh viện Trung ương Huế',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Ghép tim trẻ em từ tim hiến người lớn: kết quả và triển vọng',
                        'speaker' => 'TS.BS. Phạm Tiến Quân',
                        'org' => 'Khoa Hồi sức Tích cực Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h30',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h30 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: PHẪU THUẬT THẦN KINH',
                'chairs' => 'PGS.TS. Đồng Văn Hệ, PGS.TS. Nguyễn Thành Bắc, BSCKII. Nguyễn Tiến Dũng',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Triết lý trong phẫu thuật thần kinh: tạo đường mổ, không phải vén ép cấu trúc não',
                        'speaker' => 'PGS.TS. Đồng Văn Hệ',
                        'org' => 'Trung tâm Phẫu thuật Thần kinh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Điều trị một số bệnh bằng DBS',
                        'speaker' => 'PGS.TS. Phạm Anh Tuấn',
                        'org' => 'Khoa Ngoại Thần kinh, Bệnh viện Nguyễn Tri Phương',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Kết quả điều trị phẫu thuật u màng não nền sọ qua đường mổ ổ mắt - cung tiếp - thái dương (OZ) cải tiến',
                        'speaker' => 'PGS.TS. Dương Đại Hà',
                        'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Kết quả điều trị phẫu thuật u tuyến yên bằng đường nội soi qua một bên mũi',
                        'speaker' => 'TS.BS. Phạm Hoàng Anh',
                        'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Kết quả phẫu thuật nội soi giải ép xung đột mạch máu – thần kinh điều trị đau dây V',
                        'speaker' => 'BS. Đồng Văn Sơn',
                        'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Áp dụng đường mổ lỗ khóa khe liên bán cầu trong điều trị u màng não đường giữa',
                        'speaker' => 'ThS.BS. Văn Đức Hạnh',
                        'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Kết quả phẫu thuật u sọ hầu qua đường mổ lỗ khóa trên cung mày',
                        'speaker' => 'ThS.BS. Nguyễn Mạnh Tiến',
                        'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h10 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: PHẪU THUẬT THẦN KINH',
                'chairs' => 'PGS.TS. Dương Đại Hà, TS.BS. Nguyễn Duy Tuyển, PGS.TS. Nguyễn Văn Sơn',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Các yếu tố liên quan đến nhiễm trùng sau phẫu thuật tạo hình khuyết sọ bằng xương tự thân',
                        'speaker' => 'ThS.BS. Phạm Ngọc Huy',
                        'org' => 'Khoa Phẫu thuật Thần kinh I, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Kết quả hóa xạ trị u tế bào mầm thần kinh trung ương tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BSCKII. Đoàn Xuân Trường',
                        'org' => 'Khoa Phẫu thuật Thần kinh I, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Chẩn đoán và kết quả điều trị phẫu thuật u thần kinh đệm thân não tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Trần Đạt',
                        'org' => 'Khoa Phẫu thuật Thần kinh I, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Đánh giá kết quả điều trị u vùng tuyến yên bằng đường mổ kết hợp',
                        'speaker' => 'TS.BS. Nguyễn Duy Tuyển',
                        'org' => 'Khoa Phẫu thuật Thần kinh II, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Ứng dụng đường rạch da chữ T trong phẫu thuật mở sọ giảm áp',
                        'speaker' => 'TS.BS. Bùi Huy Mạnh',
                        'org' => 'Khoa Phẫu thuật Thần kinh II, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Kết quả can thiệp rối loạn nuốt ở người bệnh u não hố sau đã phẫu thuật',
                        'speaker' => 'ThS.BS. Nguyễn Diệu Thúy',
                        'org' => 'Khoa Phục hồi chức năng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h55',
                        'title' => 'Thực trạng tuân thủ điều trị dự phòng cấp 2 và hiệu quả tư vấn điều trị ở người bệnh nhồi máu não tại Bệnh viện Đa khoa Nông nghiệp năm 2023',
                        'speaker' => 'BSCKII. Trần Thị Lan',
                        'org' => 'Khoa Nội tổng hợp, Bệnh viện Đa khoa Nông nghiệp (Bệnh viện Hữu nghị Việt Đức)',
                    ],
                    [
                        'time' => '15h55 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Ghép tim lấy tạng hiến xa: Kết quả đa trung tâm tại Việt Nam',
                'speaker' => 'ThS.BS. Hoàng Trọng Hải',
                'org' => 'Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Đặc điểm lâm sàng và kết quả siêu âm tim sau ghép tim đồng loài trên 3 năm tại Trung tâm Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Nguyễn Thị Lan Anh',
                'org' => 'Khoa Nội, Can thiệp Tim mạch – Hô hấp, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Hẹp miệng nối tĩnh mạch chủ dưới sau ghép tim đồng loài: Báo cáo ca lâm sàng',
                'speaker' => 'ThS.BS. Đinh Thị Trang',
                'org' => 'Khoa Nội, Can thiệp Tim mạch – Hô hấp, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '4',
                'title' => 'Ghép phổi hay khối tim phổi? Vai trò của siêu âm tim',
                'speaker' => 'ThS.BS. Trần Hữu Nghị',
                'org' => 'Khoa Nội, Can thiệp Tim mạch – Hô hấp, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '5',
                'title' => 'Một số đặc điểm lâm sàng, cận lâm sàng và tình trạng huyết động của người bệnh sau ghép tim tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Nguyễn Kim Dần',
                'org' => 'Khoa Hồi sức Tích cực Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '6',
                'title' => 'Kết quả điều trị phẫu thuật u màng não không điển hình trên lều tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'PGS.TS. Dương Đại Hà, ThS.BS. Phạm Tuấn Dũng',
                'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '7',
                'title' => 'Kết quả điều trị u tuyến yên khổng lồ chế tiết prolactin',
                'speaker' => 'TS.BS. Nguyễn Thanh Xuân, ThS.BS. Nguyễn Thành Nam',
                'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '8',
                'title' => 'Đặc điểm lâm sàng, chẩn đoán hình ảnh và kết quả phẫu thuật mở nắp sọ giải ép kết hợp mở bể dịch não tủy nền sọ điều trị máu tụ nội sọ do chấn thương sọ não nặng',
                'speaker' => 'ThS.BS. Lê Anh Tuấn',
                'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '9',
                'title' => 'Kết quả điều trị người bệnh u thần kinh đệm tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Bùi Xuân Cương',
                'org' => 'Khoa Phẫu thuật Thần kinh 1, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '10',
                'title' => 'Đánh giá kết quả tạo hình khuyết hộp sọ bằng mảnh ghép PEEK 3D tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'TS.BS. Nguyễn Duy Tuyển, ThS.BS. Nguyễn Hoàng Sơn',
                'org' => 'Khoa Phẫu thuật Thần kinh 2, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '11',
                'title' => 'Đánh giá kết quả điều trị u màng não xoang hang tại Trung tâm Phẫu thuật Thần kinh, Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'BSCKII. Lê Văn Bằng, BS. Nguyễn Hoài Nam',
                'org' => 'Khoa Phẫu thuật Thần kinh 2, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-5',
        'name' => $locale === 'en' ? 'Room 216 - 2nd Floor' : 'Phòng 216 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: GHÉP TẠNG (GHÉP PHỔI & KHÍ QUẢN)',
                'chairs' => 'PGS.TS. Dương Đức Hùng, PGS.TS. Phạm Hữu Lư, TS.BS. Phạm Tiến Quân',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Ghép khí quản từ đoạn khí quản của người hiến chết não: Kinh nghiệm bước đầu tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'PGS.TS. Phạm Hữu Lư',
                        'org' => 'Khoa Ngoại Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Tổng quan về ghép phổi: Kinh nghiệm bước đầu tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'PGS.TS. Phạm Hữu Lư',
                        'org' => 'Khoa Ngoại Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Tổng quan về hồi sức sau ghép phổi',
                        'speaker' => 'TS.BS. Phạm Tiến Quân',
                        'org' => 'Trung tâm Gây mê và Hồi sức ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Lấy phổi và khối tim phổi từ người hiến đa tạng chết não tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Nguyễn Việt Anh',
                        'org' => 'Khoa Ngoại Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'Thách thức và giải pháp trong bảo quản mô khí quản đồng loại: Từ thực tiễn tại Bệnh viện Hữu nghị Việt Đức đến nhìn lại y văn',
                        'speaker' => 'TS.BS. Nguyễn Thị Định',
                        'org' => 'Trung tâm Tế bào gốc – Ngân hàng mô và Y học tái tạo, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Nhận xét biến chứng đường thở sau mổ ghép phổi từ người cho chết não tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Vũ Văn Thời',
                        'org' => 'Khoa Nội, Can thiệp Tim mạch - Hô hấp, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h25',
                        'title' => 'Vai trò của siêu âm tim đánh giá tim phải trong ghép phổi',
                        'speaker' => 'ThS.BS. Trần Hữu Nghị',
                        'org' => 'Khoa Nội, Can thiệp Tim mạch - Hô hấp, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h25 – 11h30',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h30 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: GAN MẬT – TỤY',
                'chairs' => 'PGS.TS. Nguyễn Tiến Quyết, PGS.TS. Trần Đình Thơ, TS.BS. Đỗ Mạnh Hùng',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Phẫu thuật cắt gan đối với ung thư biểu mô tế bào gan (UTBMTBG) có huyết khối ác tính tĩnh mạch cửa (HKTMC): Các thách thức hiện nay và kết quả dài hạn',
                        'speaker' => 'BSCKII. Nguyễn Đình Song Huy',
                        'org' => 'Trung tâm Ung Bướu, Bệnh viện Chợ Rẫy',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Ung thư biểu mô tế bào gan (UTBMTBG) giai đoạn sớm: Phá hủy (đốt) u tại chỗ hay Phẫu thuật cắt gan?',
                        'speaker' => 'BSCKII. Nguyễn Đình Song Huy',
                        'org' => 'Trung tâm Ung Bướu, Bệnh viện Chợ Rẫy',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Duodénopancréatectomie céphalique robotique : faisabilité, sécurité et résultats d’une expérience monocentrique',
                        'speaker' => 'Dr Thanh Tu ALBERT',
                        'org' => 'Hôpital Pitié Salpêtrière 75013 Paris',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Ứng dụng nội soi đường mật trong chẩn đoán khu trú tổn thương và lựa chọn phương pháp phẫu thuật ở u nhầy nhú nội ống đường mật',
                        'speaker' => 'BSCKII. Mẫn Văn Chung',
                        'org' => 'Khoa Phẫu thuật Gan mật, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Phẫu thuật nội soi cắt khối tá tràng đầu tụy: Tips and Tricks',
                        'speaker' => 'TS.BS. Nguyễn Thị Lan',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Kết quả phẫu thuật cắt khối tá tụy trong ung thư tụy xâm lấn mạch máu',
                        'speaker' => 'TS.BS. Ninh Việt Khải',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Vai trò điều trị trước phẫu thuật của hóa chất nút động mạch (TACE) trong ung thư biểu mô tế bào gan',
                        'speaker' => 'ThS.BSNT Phạm Thanh Tùng',
                        'org' => 'Khoa Ung bướu và Xạ trị, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h10 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: GAN MẬT – TỤY',
                'chairs' => 'PGS.TS. Trần Bảo Long, TS.BS. Đỗ Tuấn Anh, PGS.TS. Nguyễn Quang Nghĩa',
                'time' => '14h25 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Kết quả nối tụy – dạ dày sau cắt khối tá tụy',
                        'speaker' => 'ThS.BS. Trần Minh Hiếu',
                        'org' => 'Trung tâm Phẫu thuật Tiêu hóa và Bệnh lý sàn chậu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Đánh giá kết quả phẫu thuật nội soi cắt lách điều trị bệnh Thalassemia',
                        'speaker' => 'TS.BS. Hồng Quý Quân',
                        'org' => 'Khoa Phẫu thuật Nhi và Trẻ sơ sinh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Kết quả phẫu thuật triệt căn u Klatskin tại Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Ninh Việt Khải',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Kết quả phẫu thuật cho HCC giai đoạn BCLC B và C',
                        'speaker' => 'PGS.TS. Nguyễn Quang Nghĩa',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Phẫu thuật nội soi cắt gan trái, nạo vét hạch cho u Klatskin type IIIb',
                        'speaker' => 'TS.BS. Ninh Việt Khải',
                        'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Kết quả điều trị sỏi đường mật bằng phẫu thuật nội soi kết hợp tán sỏi laser tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'PGS.TS. Trần Đình Thơ',
                        'org' => 'Khoa Phẫu thuật Gan mật, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h50',
                        'title' => 'Thời điểm chỉ định phẫu thuật điều trị viêm tụy mạn: Những cập nhật mới và kinh nghiệm tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Chu Minh Phúc',
                        'org' => 'Khoa Phẫu thuật Gan mật, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h50 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Ứng dụng mô hình học máy dự đoán chấn thương bụng dựa trên dữ liệu từ hệ thống bệnh án điện tử: Kết quả bước đầu',
                'speaker' => 'BS. Chu Minh Phúc',
                'org' => 'Khoa Phẫu thuật Gan mật, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Phác đồ nền tảng pembrolizumab trong điều trị ung thư dạ dày HER2 âm tính giai đoạn tiến xa/di căn: Từ dữ liệu nghiên cứu đến thực hành lâm sàng tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'BSCKII. Võ Thị Huyền Trang',
                'org' => 'Khoa Ung bướu và Xạ trị, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Kết quả phẫu thuật ung thư biểu mô tế bào gan tại Khoa Ung bướu và Xạ trị, Bệnh viện Hữu nghị Việt Đức giai đoạn 2015–2025',
                'speaker' => 'TS.BS. Phạm Gia Anh, ThS.BS. Phan Thanh Lâm',
                'org' => 'Khoa Ung bướu và Xạ trị, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '4',
                'title' => 'Phân loại u gan phân thùy I',
                'speaker' => 'TS.BS. Ninh Việt Khải, BS. Lê Quang Thắng',
                'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-6',
        'name' => $locale === 'en' ? 'Room 210 - 2nd Floor' : 'Phòng 210 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: DƯỢC LÂM SÀNG',
                'chairs' => 'PGS.TS. Vũ Đình Hòa, DSCKII. Nguyễn Thanh Hiền, TS.BS. Nguyễn Thị Vân',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Ảnh hưởng của thay đổi dược động học trên bệnh nhân ngoại khoa đến tối ưu hóa sử dụng kháng sinh',
                        'speaker' => 'PGS.TS. Vũ Đình Hòa',
                        'org' => 'Khoa Dược lâm sàng, Trường Đại học Dược Hà Nội',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Dược lâm sàng trong ngoại khoa: Chia sẻ kinh nghiệm triển khai tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'DSCKII. Nguyễn Thanh Hiền',
                        'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Đặc điểm vi khuẩn vi nấm phân lập được từ các loại bệnh phẩm thu thập được của bệnh nhân hiến và nhận tạng ghép tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BSCKII. Trần Hải Yến',
                        'org' => 'Khoa Vi sinh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Tối ưu chế độ liều amikacin trên bệnh nhân Hồi sức tích cực ngoại khoa, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS. Lê Hương Giang',
                        'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'Phân tích kết quả theo dõi nồng độ tacrolimus trên bệnh nhân ghép tim',
                        'speaker' => 'ThS. Chu Thị Kim Phương',
                        'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Triển khai quy trình kháng sinh dự phòng với sự tham gia của DSLS trên một số phẫu thuật tại khoa Ngoại Tim mạch – lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'DS. Võ Thị Hương Thảo',
                        'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h30',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h30 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: TIÊU HÓA – BỆNH LÝ SÀN CHẬU',
                'chairs' => 'PGS.TS. Nguyễn Đức Tiến, PGS.TS. Lê Tư Hoàng, TS.BS. Đỗ Tất Thành',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Tình trạng dinh dưỡng và chế độ nuôi dưỡng người bệnh Phẫu Thuật Ung Thư đại trực tràng tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'CNDD. Chu Thị Trang',
                        'org' => 'Khoa Dinh Dưỡng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Cập nhật các kĩ thuật cầm máu cấp cứu và ứng dụng các vật liệu cầm máu trong phẫu thuật ung thư phụ khoa',
                        'speaker' => 'PGS.TS. Nguyễn Quốc Tuấn',
                        'org' => 'Bệnh viện Phụ sản Trung ương, Trường Đại học Y Hà Nội',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Đánh giá kết quả điều trị viêm túi thừa đại tràng tại Bệnh viện Hữu nghị Việt Đức giai đoạn 2019–2024',
                        'speaker' => 'PGS.TS. Lê Tư Hoàng',
                        'org' => 'Khoa Điều trị theo yêu cầu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Đánh giá kết quả sớm phẫu thuật nội soi nạo vét hạch có sử dụng ICG trong điều trị ung thư đại tràng sigma và trực tràng cao',
                        'speaker' => 'TS.BS. Quách Văn Kiên',
                        'org' => 'Khoa Phẫu thuật Tiêu hóa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Phân tích nạo vét hạch trong ung thư dạ dày',
                        'speaker' => 'ThS.BS. Nguyễn Thị Thanh Tâm',
                        'org' => 'Khoa Phẫu thuật Tiêu hóa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Đánh giá kết quả phẫu thuật cắt toàn bộ thực quản và dạ dày trong điều trị ung thư đồng thời tại thực quản và dạ dày',
                        'speaker' => 'TS.BS. Nguyễn Xuân Hòa',
                        'org' => 'Khoa Phẫu thuật Tiêu hóa, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: TIÊU HÓA – BỆNH LÝ SÀN CHẬU',
                'chairs' => 'GS.TS. Trịnh Hồng Sơn, PGS.TS. Nguyễn Đức Chính, TS.BS. Dương Trọng Hiền',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Đánh giá kết quả điều trị đứt cơ thắt hậu môn do đẻ thường bằng phương pháp Musset',
                        'speaker' => 'TS.BS. Đỗ Tất Thành',
                        'org' => 'Trung tâm Phẫu thuật Tiêu hoá và Bệnh lý sàn chậu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Kết quả điều trị viêm xoang tổ lông bằng phương pháp chuyển vạt da',
                        'speaker' => 'BSCKII. Nguyễn Đắc Thao',
                        'org' => 'Trung tâm Phẫu thuật Tiêu hoá và Bệnh lý sàn chậu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Đánh giá kết quả điều trị rò hậu môn bằng laser diode (FiLaC) tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BSCKII. Nguyễn Đắc Thao',
                        'org' => 'Trung tâm Phẫu thuật Tiêu hoá và Bệnh lý sàn chậu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Kết quả sớm điều trị rò hậu môn bằng phương pháp TROPIS tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BSCKII. Phạm Phúc Khánh',
                        'org' => 'Trung tâm Phẫu thuật Tiêu hoá và Bệnh lý sàn chậu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Quelle place pour la chirurgie robotique dans la cytoréduction et CHIP des carcinoses péritonéales',
                        'speaker' => 'Dr Thanh Tu ALBERT',
                        'org' => 'Hôpital Pitié Salpêtrière 75013 Paris',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Đặc điểm lâm sàng, cận lâm sàng của rò hậu môn do tổn thương đặc hiệu được phẫu thuật tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Nguyễn Thị Lý',
                        'org' => 'Trung tâm Phẫu thuật Tiêu hoá và Bệnh lý sàn chậu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Phân tích hiệu quả can thiệp của chương trình quản lý sử dụng linezolid tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'DS. Lê Thị Minh Hằng',
                'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Phân tích danh mục thuốc sử dụng tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'DS. Tạ Quang Trung',
                'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Hiệu chỉnh liều vancomycin thông qua giám sát nồng độ thuốc trong máu trên Bệnh nhân lọc máu ngắt quãng (IHD)',
                'speaker' => 'DS. Bùi Thu Trang',
                'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '4',
                'title' => 'Triển khai quy trình kháng sinh dự phòng với sự tham gia của DSLS trên một số phẫu thuật tại khoa Ngoại Tim mạch – lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'DS. Võ Thị Hương Thảo',
                'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '5',
                'title' => 'Báo cáo tình hình sử dụng kháng sinh tại Bệnh viện Hữu nghị Việt Đức năm 2025',
                'speaker' => 'DS. Nguyễn Thùy Dương',
                'org' => 'Khoa Dược, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-7',
        'name' => $locale === 'en' ? 'Room 207 - 2nd Floor' : 'Phòng 207 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: ĐIỀU DƯỠNG',
                'chairs' => 'ThS. Phạm Đức Mục, TS. Hà Thị Kim Phượng, PGS.TS. Nguyễn Hoàng Long, TS.ĐD Trần Văn Oánh',
                'time' => '10h15 – 12h00',
                'items' => [
                    [
                        'time' => '10h15 – 10h30',
                        'title' => 'Phát triển dịch vụ chăm sóc điều dưỡng trong bệnh viện: Nhận diện điểm nghẽn – khơi thông dòng chảy giá trị',
                        'speaker' => 'ThS. Phạm Đức Mục',
                        'org' => 'Hiệp hội Điều dưỡng Việt Nam',
                    ],
                    [
                        'time' => '10h30 – 10h45',
                        'title' => 'Kết quả thực hiện dự án Chẩn đoán điều dưỡng, Can thiệp điều dưỡng và Lượng giá kết quả chăm sóc điều dưỡng tại Bệnh viện Hữu nghị Việt Đức và các bệnh viện trên địa bàn Hà Nội',
                        'speaker' => 'Ghislaine PAUTARD',
                        'org' => 'ADCV – Hiệp hội Phát triển Ngoại khoa tại Việt Nam, Bệnh viện Đại học Limoges, Cộng hòa Pháp',
                    ],
                    [
                        'time' => '10h45 – 11h00',
                        'title' => 'Quản lý chăm sóc bệnh nhân phẫu thuật phức tạp trong kỷ nguyên số: Kinh nghiệm quốc tế và các giải pháp thích ứng tại Việt Nam',
                        'speaker' => 'Kathryn Lynn COWIE',
                        'org' => 'Khoa Hồi sức tích cực Phẫu thuật Tim, Bệnh viện Đại học, Trung tâm Khoa học Sức khỏe London, Ontario, Canada',
                    ],
                    [
                        'time' => '11h00 – 11h15',
                        'title' => 'Chuyển đổi số trong công tác giám sát quy trình kỹ thuật Điều dưỡng tại Bệnh viện Quân Y 103',
                        'speaker' => 'ĐD. Phạm Duy Thắng',
                        'org' => 'Khoa Hồi sức cấp cứu, Bệnh viện Quân Y 103',
                    ],
                    [
                        'time' => '11h15 – 11h30',
                        'title' => 'Đánh giá hiệu quả bước đầu bộ mã hóa ma trận logic phiếu theo dõi, chăm sóc sản phụ khoa trên hệ thống HIS tại Bệnh viện Phụ Sản Trung ương',
                        'speaker' => 'ĐD. Lê Thị Thái Vân',
                        'org' => 'Phòng Điều dưỡng, Bệnh viện Phụ sản Trung ương',
                    ],
                    [
                        'time' => '11h45 – 12h00',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '12h00 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: ĐIỀU DƯỠNG',
                'chairs' => 'TS. Phan Thị Dung, TS. Nguyễn Thị Lan Anh, TS. Đào Đức Hạnh, ThS. Chu Văn Long',
                'time' => '13h00 – 15h00',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Xác định các yếu tố tiên lượng thời gian xuất hiện loét tỳ đè ở người bệnh Hồi sức tích cực: một nghiên cứu thuần tập',
                        'speaker' => 'TS. Đỗ Thị Thu Hiền',
                        'org' => 'Khoa Điều dưỡng, Trường Đại học Kỹ thuật Y tế Hải Dương',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Đánh giá đau và một số yếu tố liên quan trên người bệnh ung thư gan nguyên phát điều trị chăm sóc giảm nhẹ tại Bệnh viện Chợ Rẫy năm 2025',
                        'speaker' => 'ĐD. Nguyễn Huỳnh Ngọc Phúc',
                        'org' => 'Khoa Điều trị giảm nhẹ, Bệnh viện Chợ Rẫy',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Thời gian lưu và biến chứng của kim luồn tĩnh mạch ngoại vi hệ thống kín so với hệ thống mở tại đơn vị hồi sức ngoại, Bệnh viện Đà Nẵng',
                        'speaker' => 'ĐD. Phan Thế Anh',
                        'org' => 'Khoa Gây mê Hồi sức Cấp cứu, Bệnh viện Đà Nẵng',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Tối ưu hóa chăm sóc vết thương: từ nhận định đến thực hành qua 04 ca lâm sàng',
                        'speaker' => 'ĐD. Huỳnh Thị Thu Thảo',
                        'org' => 'Khoa Chấn thương, Bệnh viện Trung ương Huế',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Chất lượng cuộc sống và một số yếu tố liên quan của người bệnh sau ghép phổi tại Bệnh viện Phổi Trung ương năm 2025-2026',
                        'speaker' => 'ĐDCKI. Vũ Mai Lan',
                        'org' => 'Phòng Điều dưỡng, Bệnh viện Phổi Trung ương',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Thực trạng sảng ở bệnh nhân thở máy và một số yếu tố liên quan',
                        'speaker' => 'ThS.ĐD Đinh Thị Thanh Huệ',
                        'org' => 'Khoa Cấp cứu và Hồi sức tích cực, Bệnh viện Đại học Y Hà Nội',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Đánh giá kết quả chăm sóc bệnh nhân sau phẫu thuật chỉnh vẹo cột sống thắt lưng do thoái hoá tại Bệnh viện Trung ương Quân đội 108',
                        'speaker' => 'ĐD. Bùi Vân Dung',
                        'org' => 'Khoa Chấn thương Chỉnh hình Cột sống, Bệnh viện Trung ương Quân đội 108',
                    ],
                    [
                        'time' => '14h10 – 14h20',
                        'title' => 'Chăm sóc trẻ sau phẫu thuật U cột sống phức tạp tại Bệnh viện Đa khoa Xanh Pôn - Báo cáo ca lâm sàng',
                        'speaker' => 'ĐD. Nguyễn Thành Ninh',
                        'org' => 'Khoa Phẫu thuật Thần kinh, Bệnh viện Đa khoa Xanh Pôn',
                    ],
                    [
                        'time' => '14h20 – 14h30',
                        'title' => 'Vai trò của điều dưỡng trong an toàn người bệnh khi chụp cộng hưởng từ (MRI) - góc nhìn từ những sự cố y khoa không mong muốn',
                        'speaker' => 'ĐD. Đỗ Mạnh Quyền',
                        'org' => 'Khoa Ngoại tổng hợp, Bệnh viện Giao thông Vận tải',
                    ],
                    [
                        'time' => '14h30 – 14h50',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: ĐIỀU DƯỠNG',
                'chairs' => 'TS. Nguyễn Thị Minh Chính, TS. Bùi Minh Thu, ThS. Nguyễn Thị Oanh, ThS. Bùi Thị Kim Nhung',
                'time' => '15h00 – 16h45',
                'items' => [
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Development of a Digital Management Software System for Quality Management of Patient Care at Bach Mai Hospital in 2026',
                        'speaker' => 'TS. Nguyễn Thị Hương Giang',
                        'org' => 'Phòng Điều dưỡng và Chăm sóc người bệnh, Bệnh viện Bạch Mai',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Advancing the Role of Oncology Nursing at Vinmec',
                        'speaker' => 'ThS.ĐD Mohammad Ahmad Toma Guzo',
                        'org' => 'Trung tâm Ung bướu, Bệnh viện Đa khoa Quốc tế Vinmec Central Park',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Predictors of quality of nursing care among staff nurses in selected university hospitals in Hanoi: Basis for framework development',
                        'speaker' => 'TS.ĐD Trần Văn Oánh',
                        'org' => 'Trưởng phòng Điều dưỡng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Palliative Care: Its Importance and Scope of Application in Patient Care',
                        'speaker' => 'TS. Trần Thị Ngọc Xuyến',
                        'org' => 'Viện Cơ Xương Khớp, Bệnh viện Bạch Mai',
                    ],
                    [
                        'time' => '15h40 – 15h50',
                        'title' => 'Health Information Technology Usability and Nurses’ Job Satisfaction in Vietnam: The Indirect Role of Career Adapt-Abilities',
                        'speaker' => 'ThS. Phạm Thị Kiên',
                        'org' => 'Khoa Điều dưỡng, Trường Đại học Phan Châu Trinh',
                    ],
                    [
                        'time' => '15h50 – 16h00',
                        'title' => 'Assessing the Effectiveness of Aseptic Non-Touch Technique (ANTT) Training in Improving Nurses’ Knowledge and Skills in Peripheral Intravenous Cannulation at Selected Hospitals in Vietnam',
                        'speaker' => 'TS. Lê Đỗ Phương Uyên',
                        'org' => 'Phòng Điều dưỡng, Bệnh viện Quốc tế COLUMBIA ASIA Bình Dương',
                    ],
                    [
                        'time' => '16h00 – 16h10',
                        'title' => 'Unmet supportive care needs following primary treatment among colorectal cancer survivors in Vietnam',
                        'speaker' => 'ThS. Nguyễn Thị Dân',
                        'org' => 'Bộ môn Điều dưỡng và Huấn luyện kỹ năng, Trường Đại học Y Dược – Đại học Quốc gia Hà Nội',
                    ],
                    [
                        'time' => '16h10 – 16h20',
                        'title' => 'Translation and evaluation of the validity and reliability of the Vietnamese version of the Expected Knowledge of Hospital Patients scale',
                        'speaker' => 'ThS.ĐD Nguyễn Thị Chinh',
                        'org' => 'Phòng Điều dưỡng, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '16h20 – 16h45',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h45',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
        ]
    ],
    [
        'id' => 'hoi-truong-8',
        'name' => $locale === 'en' ? 'Room 219 - 2nd Floor' : 'Phòng 219 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: TIM MẠCH – LỒNG NGỰC (PHẪU THUẬT TIM MẠCH LỒNG NGỰC – ĐỘNG MẠCH CHỦ NGỰC)',
                'chairs' => 'PGS.TS. Dương Đức Hùng, TS.BS. Nguyễn Thái An, ThS.BS. Nguyễn Tùng Sơn',
                'time' => '10h15 – 11h45',
                'items' => [
                    [
                        'time' => '10h15 – 10h25',
                        'title' => 'Hybrid điều trị bệnh động mạch chủ tại Bệnh viện Trung ương Quân đội 108: Chỉ định và kết quả',
                        'speaker' => 'TS.BS. Nguyễn Tuấn Anh',
                        'org' => 'Khoa Phẫu thuật Tim mạch, Bệnh viện Trung ương Quân đội 108',
                    ],
                    [
                        'time' => '10h25 – 10h35',
                        'title' => 'Kinh nghiệm thay quai động mạch chủ tại Bệnh viện Chợ Rẫy',
                        'speaker' => 'TS.BS. Nguyễn Thái An',
                        'org' => 'Khoa Hồi sức – Phẫu thuật Tim, Bệnh viện Chợ Rẫy',
                    ],
                    [
                        'time' => '10h35 – 10h45',
                        'title' => 'Kinh nghiệm điều trị chấn thương động mạch chủ ngực bằng phương pháp can thiệp nội mạch đặt stent-graft tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Nguyễn Tùng Sơn',
                        'org' => 'Khoa Nội, Can thiệp Tim mạch – Hô hấp, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Can thiệp nội mạch điều trị phình động mạch chủ bụng có giải phẫu cổ túi phình phức tại kinh nghiệm Bệnh viện Chợ Rẫy',
                        'speaker' => 'TS.BS. Lâm Văn Nút',
                        'org' => 'Khoa Phẫu thuật Mạch máu, Bệnh viện Chợ Rẫy',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'PMEG trong thực hành lâm sàng, chia sẻ kinh nghiệm và ca lâm sàng từ Bệnh viện Trung ương Quân đội 108',
                        'speaker' => 'ThS.BS. Lê Hữu Khánh',
                        'org' => 'Khoa Chẩn đoán và Can thiệp Tim mạch, Viện Tim mạch, Bệnh viện Trung ương Quân đội 108',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Kinh nghiệm can thiệp điều trị bệnh lý phình ĐMC ngực – bụng phức bằng stentgraft có nhánh tại Bệnh viện Đại học Y Dược Hồ Chí Minh',
                        'speaker' => 'TS.BS. Phạm Trần Việt Chương',
                        'org' => 'Khoa Phẫu thuật Tim mạch, Bệnh viện Đại học Y dược TP. Hồ Chí Minh',
                    ],
                    [
                        'time' => '11h15 – 11h25',
                        'title' => 'Chia sẻ kinh nghiệm điều trị bệnh lý động mạch chủ phức tạp tại Bệnh viện E',
                        'speaker' => 'ThS.BS. Nguyễn Hoàng Nam',
                        'org' => 'Đơn vị Mạch máu, Trung tâm Tim mạch, Bệnh viện E',
                    ],
                    [
                        'time' => '11h25 – 11h45',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h45 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: TIM MẠCH – LỒNG NGỰC (PHẪU THUẬT TIM MẠCH LỒNG NGỰC – ĐỘNG MẠCH CHỦ NGỰC)',
                'chairs' => 'PGS.TS. Nguyễn Sinh Hiền, TS.BS. Nguyễn Công Hựu, PGS.TS. Phùng Duy Hồng Sơn',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h10',
                        'title' => 'Kỹ thuật phẫu thuật tim nội soi toàn bộ qua các lỗ trocar',
                        'speaker' => 'TS.BS. Nguyễn Công Hựu',
                        'org' => 'Khoa Phẫu thuật Tim mạch và Lồng ngực, Trung tâm Tim mạch - Bệnh viện E',
                    ],
                    [
                        'time' => '13h10 – 13h20',
                        'title' => 'Phẫu thuật đa van tim ít xâm lấn tại Bệnh viện Tim Hà Nội: kỹ thuật và kết quả',
                        'speaker' => 'PGS.TS. Nguyễn Sinh Hiền',
                        'org' => 'Bệnh viện Tim Hà Nội',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => 'Phẫu thuật tim ít xâm lấm tại Bệnh viện Quân y 103',
                        'speaker' => 'TS.BS. Vũ Đức Thắng',
                        'org' => 'Khoa Phẫu thuật Tim mạch, Bệnh viện Quân Y 103',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Kinh nghiệm phẫu thuật van động mạch chủ không khâu tại Bệnh viện Bạch Mai',
                        'speaker' => 'TS.BS. Ngô Phi Long',
                        'org' => 'Khoa Phẫu thuật Tim mạch và Hồi sức tích cực sau mổ - Viện Tim mạch, Bệnh viện Bạch Mai',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Phẫu thuật ít xâm lấn thay quai động mạch chủ: Làm như thế nào?',
                        'speaker' => 'PGS.TS. Phùng Duy Hồng Sơn',
                        'org' => 'Khoa Phẫu thuật Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Phẫu thuật ít xâm lấn thay van ĐMC qua đường nách trước sử dụng van không khâu Perceval',
                        'speaker' => 'ThS.BS. Hoàng Trọng Hải',
                        'org' => 'Khoa Phẫu thuật Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h15',
                        'title' => 'Phẫu thuật điều trị bệnh động mạch chủ ngực bụng: kinh nghiệm tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Dương Ngọc Thắng',
                        'org' => 'Khoa Phẫu thuật Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h15 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: TIM MẠCH – LỒNG NGỰC (PHẪU THUẬT LỒNG NGỰC)',
                'chairs' => 'PGS.TS. Phạm Hữu Lư, TS.BS. Nguyễn Duy Thắng, TS.BS. Ngô Gia Khánh',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h55',
                        'title' => 'So sánh kết quả sớm phẫu thuật nội soi lồng ngực 1 và 2 ngõ vào điều trị ung thư phổi không tế bào nhỏ tại Bệnh viện hữu nghị Việt Đức',
                        'speaker' => 'PGS.TS. Phạm Hữu Lư',
                        'org' => 'Khoa Ngoại Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h55 – 15h10',
                        'title' => 'Tổng quan về phẫu thuật lồng ngực tại Bệnh viện Đại học Y Hà Nội',
                        'speaker' => 'TS.BS. Nguyễn Duy Thắng',
                        'org' => 'Khoa Ngoại Tim mạch và Lồng ngực, Bệnh viện Đại học Y Hà Nội',
                    ],
                    [
                        'time' => '15h10 – 15h25',
                        'title' => 'Cắt hạ phân thuỳ phổi trong điều trị ung thư phổi không tế bào nhỏ',
                        'speaker' => 'TS.BS. Ngô Gia Khánh',
                        'org' => 'Khoa Nội, Can thiệp Tim mạch – Hô hấp, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h25 – 15h40',
                        'title' => 'Phẫu thuật lồi ngực tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'BSCKII. Nguyễn Việt Anh',
                        'org' => 'Khoa Ngoại Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h55',
                        'title' => 'Tiếp cận dưới mũi ức trong điều trị các bệnh lý lồng ngực',
                        'speaker' => 'ThS.BS. Đồng Minh Hùng',
                        'org' => 'Khoa Phẫu thuật Lồng ngực, Bệnh viện Bạch Mai',
                    ],
                    [
                        'time' => '15h55 – 16h05',
                        'title' => 'Kết quả điều trị vỡ nhu mô phổi do chấn thương tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Nguyễn Minh Trí',
                        'org' => 'Trung tâm Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '16h05 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Phục hồi chức năng sớm trên bệnh nhân phẫu thuật tim và các yếu tố ảnh hưởng đến kết quả tập Phục hồi chức năng',
                'speaker' => 'ThS.BS. Nguyễn Thị Mỹ Linh',
                'org' => 'Khoa Phục hồi chức năng, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'Kinh nghiệm 5 năm phẫu thuật lóc động mạch chủ type A cấp tính tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Nguyễn Văn Đàn, ThS.BS. Vũ Xuân Hiệp, ThS.BS. Hoàng Trọng Hải, PGS.TS. Phùng Duy Hồng Sơn, PGS.TS. Dương Đức Hùng và CS',
                'org' => 'Trung tâm Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '3',
                'title' => 'Điều trị phình ĐMC bụng nhiễm trùng: kinh nghiệm từ Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'TS.BS. Dương Ngọc Thắng, PGS.TS. Phùng Duy Hồng Sơn, PGS.TS. Dương Đức Hùng và CS',
                'org' => 'Trung tâm Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '4',
                'title' => 'Kinh nghiệm sử dụng mạch lai Thoraflex và Evita tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Lê Trường Giang, ThS.BS. Hoàng Trọng Hải, PGS.TS. Phùng Duy Hồng Sơn, PGS.TS. Dương Đức Hùng và CS',
                'org' => 'Trung tâm Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '5',
                'title' => 'Kết quả điều trị gãy xương ức do chấn thương tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'ThS.BS. Nguyễn Huy Hoàng, ThS.BS. Nguyễn Minh Trí, BSCKII. Nguyễn Việt Anh, PGS.TS. Phạm Hữu Lư',
                'org' => 'Trung tâm Tim mạch và Lồng ngực, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '6',
                'title' => 'Vai trò của định vị ICG trong định vị các nốt phổi tại Bệnh viện Đại học Y Hà Nội',
                'speaker' => 'ThS.BS. Nguyễn Duy Gia, TS.BS. Nguyễn Duy Thắng',
                'org' => 'Đơn vị Phẫu thuật Tim mạch – Lồng ngực, Bệnh viện Đại học Y Hà Nội'
            ]
        ]
    ],
    [
        'id' => 'hoi-truong-9',
        'name' => $locale === 'en' ? 'Room 217 - 2nd Floor' : 'Phòng 217 - Tầng 2',
        'room' => null,
        'badge' => null,
        'sessions' => [
            [
                'session_num' => 2,
                'name' => 'PHIÊN 2: CHẨN ĐOÁN HÌNH ẢNH',
                'chairs' => 'M.D Sang Yub Le, PGS.TS. Lê Thanh Dũng, BSCKII. Phạm Hữu Khuyên',
                'time' => '10h15 – 11h30',
                'items' => [
                    [
                        'time' => '10h15 – 10h45',
                        'title' => 'Endovascular Management of Peripheral AVMs – Imaging, Approaches, and Embolization Agents',
                        'speaker' => 'M.D Sang Yub Le',
                        'org' => 'Department of Radiology, Samsung Medical Center, Sungkyunkwan University School of Medicine, Seoul, Korea',
                    ],
                    [
                        'time' => '10h45 – 10h55',
                        'title' => 'Can thiệp nội mạch điều trị dị dạng mạch máu vùng đầu, mặt, cổ: Từ lý thuyết đến thực tiễn tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Đào Xuân Hải',
                        'org' => 'Khoa Chẩn đoán hình ảnh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '10h55 – 11h05',
                        'title' => 'Dị dạng thông động – tĩnh mạch vùng tiểu khung: Thách thức trong chẩn đoán và kinh nghiệm can thiệp qua da',
                        'speaker' => 'TS.BS. Thân Văn Sỹ',
                        'org' => 'Khoa Chẩn đoán hình ảnh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h05 – 11h15',
                        'title' => 'Tối ưu hóa kết quả điều trị dị dạng mạch máu chi dưới: Vai trò của can thiệp nội mạch phối hợp',
                        'speaker' => 'ThS.BS. Vũ Hoài Linh',
                        'org' => 'Khoa Chẩn đoán hình ảnh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h15 – 11h25',
                        'title' => 'Ứng dụng các kỹ thuật chẩn đoán hình ảnh tiên tiến (4D-MRA, Dual-energy CT) trong lập kế hoạch điều trị bệnh lý mạch máu',
                        'speaker' => 'ThS.BS. Trần Quang Lộc',
                        'org' => 'Khoa Chẩn đoán hình ảnh, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '11h25 – 11h40',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '11h40 – 13h00',
                        'title' => 'Ăn trưa',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 3,
                'name' => 'PHIÊN 3: PHẪU THUẬT TẠO HÌNH – THẨM MỸ',
                'chairs' => 'Prof. Dr. Ömer Özkan, PGS.TS. Nguyễn Hồng Hà, TS. Vũ Trung Trực',
                'time' => '13h00 – 14h25',
                'items' => [
                    [
                        'time' => '13h00 – 13h20',
                        'title' => 'Extreme reconstructions',
                        'speaker' => 'Prof. Dr Ömer Özkan',
                        'org' => 'Phẫu thuật Tạo hình, Tái tạo và Thẩm mỹ',
                    ],
                    [
                        'time' => '13h20 – 13h30',
                        'title' => '20 năm phát triển phẫu thuật sọ mặt tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Vũ Trung Trực',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h30 – 13h40',
                        'title' => 'Tính thẩm mỹ trong vi phẫu thuật: Kinh nghiệm bản thân và nhìn lại y văn',
                        'speaker' => 'TS.BS. Bùi Mai Anh',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h40 – 13h50',
                        'title' => 'Trồng lại bộ phận đứt rời vùng đầu mặt tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'TS.BS. Đào Văn Giang',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '13h50 – 14h00',
                        'title' => 'Ứng dụng công nghệ 3D trong di chuyển phức hợp hàm trên – hàm dưới điều trị bất cân xứng xương hàm mặt',
                        'speaker' => 'BS. Thịnh Thái',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h00 – 14h10',
                        'title' => 'Tạo hình khuyết đoạn xương đùi bằng vạt xương mác vi phẫu',
                        'speaker' => 'BS. Dương Hồng Quân',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h10 – 14h25',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '14h25 – 14h40',
                        'title' => 'Tea-break',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ],
            [
                'session_num' => 4,
                'name' => 'PHIÊN 4: PHẪU THUẬT TẠO HÌNH – THẨM MỸ',
                'chairs' => 'PGS.TS. Vũ Ngọc Lâm, TS.BS. Đỗ Thị Ngọc Linh, TS.BS. Bùi Mai Anh',
                'time' => '14h40 – 16h15',
                'items' => [
                    [
                        'time' => '14h40 – 14h50',
                        'title' => 'Cập nhật điều trị u xơ thần kinh thể đám rối',
                        'speaker' => 'TS.BS. Vũ Trung Trực',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '14h50 – 15h00',
                        'title' => 'Dị dạng động – tĩnh mạch vùng đầu, mặt, cổ: Kết quả điều trị và các yếu tố liên quan đến khả năng tái phát sau điều trị',
                        'speaker' => 'TS.BS. Đỗ Thị Ngọc Linh',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h00 – 15h10',
                        'title' => 'Báo cáo ba trường hợp tạo hình niệu đạo bằng vạt da dương vật ở người bệnh hẹp niệu đạo tái phát kèm mất đoạn niệu đạo: Bàn luận khả năng ứng dụng vạt bàng quang có cuống trong các trường hợp phức tạp',
                        'speaker' => 'TS.BS. Đỗ Ngọc Sơn, BS. Nguyễn Đạo Uyên',
                        'org' => 'Khoa Phẫu thuật Tiết niệu, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h10 – 15h20',
                        'title' => 'Ứng dụng bảo quản dây thần kinh từ người hiến và ghép lại tại Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS.BS. Dương Công Nguyên',
                        'org' => 'Khoa Sinh hóa - Huyết học - Ngân hàng Mô, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h20 – 15h30',
                        'title' => 'Ứng dụng động mạch ngực ngoài trong phẫu thuật tạo hình thẩm mỹ',
                        'speaker' => 'ThS.BS. Nguyễn Thị Thu Hằng',
                        'org' => 'Khoa Phẫu thuật Hàm mặt - Tạo hình - Thẩm mỹ, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h30 – 15h40',
                        'title' => 'Tổng quan các nghiên cứu điều trị hội chứng ngừng thở khi ngủ do tắc nghẽn bằng máng kéo hàm dưới',
                        'speaker' => 'BS. Nguyễn Hoàng Hải',
                        'org' => 'Trung tâm Khám bệnh - Cấp cứu và Điều trị ban ngày, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h40 – 15h50',
                        'title' => 'Thực trạng nhiễm khuẩn các sản phẩm mô bảo quản tại Ngân hàng Mô, Bệnh viện Hữu nghị Việt Đức',
                        'speaker' => 'ThS. Nguyễn Văn Chỉnh',
                        'org' => 'Khoa Sinh hóa - Huyết học - Ngân hàng Mô, Bệnh viện Hữu nghị Việt Đức',
                    ],
                    [
                        'time' => '15h50 – 16h15',
                        'title' => 'Thảo luận',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ],
                    [
                        'time' => '16h15',
                        'title' => 'BẾ MẠC',
                        'speaker' => null,
                        'org' => null,
                        'is_break' => true
                    ]
                ]
            ]
        ],
        'posters' => [
            [
                'id' => '1',
                'title' => 'Phân bố các dạng động mạch thận dựa trên hình ảnh MSCT 256 dãy và ứng dụng trong phẫu thuật nội soi: Kết quả 900 trường hợp tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'PGS.TS. Lê Nguyên Vũ',
                'org' => 'Trung tâm Ghép tạng, Bệnh viện Hữu nghị Việt Đức'
            ],
            [
                'id' => '2',
                'title' => 'An toàn và hiệu quả của tiêm giảm đau cột sống dưới siêu âm: Tổng quan và báo cáo loạt ca tại Bệnh viện Hữu nghị Việt Đức',
                'speaker' => 'TS.BS. Nguyễn Hoàng Long',
                'org' => 'Khoa Phẫu thuật Cột sống, Bệnh viện Hữu nghị Việt Đức'
            ]
        ]
    ]
];
@endphp

<x-conference-hero-title 
    :title="$locale === 'en' ? 'Scientific Program' : 'Chương trình Khoa học Chi tiết'" 
    :subtitle="$locale === 'en' ? 'Viet Duc University Hospital International Scientific Conference 2026 · Thursday, Nov 19, 2026' : 'Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026 · Thứ Năm, ngày 19/11/2026 tại Trung tâm Hội nghị Quốc gia'" 
    :badge="$locale === 'en' ? 'OFFICIAL SCIENTIFIC PROGRAM' : 'CHƯƠNG TRÌNH KHOA HỌC CHÍNH THỨC'" 
/>

<section class="py-10 md:py-16 bg-slate-50" x-data="{ 
    selectedHall: 'all',
    selectedSession: 'all',
    searchQuery: '',
    matchesSearch(item, session, hall) {
        if (!this.searchQuery.trim()) return true;
        const q = this.searchQuery.toLowerCase().trim();
        const textToSearch = [
            item.title || '',
            item.speaker || '',
            item.org || '',
            session.name || '',
            session.chairs || '',
            hall.name || '',
            hall.room || '',
            hall.badge || ''
        ].join(' ').toLowerCase();
        return textToSearch.includes(q);
    },
    matchesPosterSearch(poster, hall) {
        if (!this.searchQuery.trim()) return true;
        const q = this.searchQuery.toLowerCase().trim();
        const textToSearch = [
            poster.title || '',
            poster.speaker || '',
            poster.org || '',
            hall.name || '',
            hall.room || '',
            hall.badge || ''
        ].join(' ').toLowerCase();
        return textToSearch.includes(q);
    },
    hasMatchingItemsInSession(session, hall) {
        return session.items.some(item => this.matchesSearch(item, session, hall));
    },
    hasMatchingPostersInHall(hall) {
        if (!hall.posters || hall.posters.length === 0) return false;
        return hall.posters.some(p => this.matchesPosterSearch(p, hall));
    },
    hasMatchingItemsInHall(hall) {
        const hasMatchingSession = hall.sessions.some(session => {
            if (this.selectedSession !== 'all' && String(session.session_num) !== String(this.selectedSession)) return false;
            return this.hasMatchingItemsInSession(session, hall);
        });
        if (hasMatchingSession) return true;
        if ((this.selectedSession === 'all' || this.selectedSession === 'poster') && this.hasMatchingPostersInHall(hall)) {
            return true;
        }
        return false;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        <!-- Section 1: Chương trình tổng thể Hội nghị Khoa học Quốc tế -->
        <section id="hoi-nghi" aria-labelledby="hoi-nghi-title" class="scroll-mt-32 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8 space-y-3 border-b border-slate-200">
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                    {{ $locale === 'en' ? 'Nov 19, 2026 · Overall Timeline' : '19/11/2026 · Khung thời gian tổng thể' }}
                </span>
                <h2 id="hoi-nghi-title" class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ $locale === 'en' ? 'Viet Duc University Hospital International Scientific Conference 2026 Program' : 'Chương trình Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026' }}
                </h2>
                <p class="text-sm text-slate-600">
                    <strong class="text-slate-800">{{ $locale === 'en' ? 'Time:' : 'Thời gian:' }}</strong> 
                    {{ $locale === 'en' ? '07:30 – 17:00, Thursday, November 19, 2026' : '07h30 – 17h00, thứ Năm, ngày 19/11/2026' }}
                </p>
                <p class="text-sm text-slate-600">
                    <strong class="text-slate-800">{{ $locale === 'en' ? 'Venue:' : 'Địa điểm:' }}</strong> 
                    {{ $locale === 'en' ? 'National Convention Center, Thang Long Avenue, Nam Tu Liem, Hanoi' : 'Trung tâm Hội nghị Quốc gia, Đại lộ Thăng Long, Từ Liêm, Hà Nội' }}
                </p>
            </div>
            <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-emerald-700" tabindex="0" role="region" aria-labelledby="hoi-nghi-title">
                <table class="w-full min-w-[640px] text-sm text-left">
                    <caption class="sr-only">Chương trình ngày 19/11/2026</caption>
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col" class="w-1/4 px-6 sm:px-8 py-4 font-semibold border-r border-white/20">{{ $locale === 'en' ? 'Time' : 'Thời gian' }}</th>
                            <th scope="col" class="w-1/3 px-6 py-4 font-semibold border-r border-white/20">{{ $locale === 'en' ? 'Program / Content' : 'Nội dung' }}</th>
                            <th scope="col" class="px-6 sm:px-8 py-4 font-semibold">{{ $locale === 'en' ? 'Person in Charge / Participants' : 'Phụ trách' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($conferenceSchedule as [$time, $activity, $responsible])
                            <tr class="odd:bg-white even:bg-slate-50 hover:bg-emerald-50/60">
                                <th scope="row" class="px-6 sm:px-8 py-5 font-bold text-emerald-800 whitespace-nowrap border-r border-slate-200">{{ $time }}</th>
                                <td class="px-6 py-5 font-semibold text-slate-900 border-r border-slate-200">{{ $activity }}</td>
                                <td class="px-6 sm:px-8 py-5 text-slate-600">{{ $responsible ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 2: Hall Breakdown (Tóm tắt chương trình Hội nghị theo hội trường) -->
        <section aria-labelledby="hall-schedule-title" class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8 space-y-3 border-b border-slate-200">
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                    {{ $locale === 'en' ? 'Scientific Tracks Summary' : 'Tóm tắt các phiên khoa học' }}
                </span>
                <h2 id="hall-schedule-title" class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ $locale === 'en' ? 'Conference Program by Hall & Specialty' : 'Tóm tắt chương trình Hội nghị theo hội trường' }}
                </h2>
                <p id="hall-schedule-help" class="text-xs sm:text-sm text-slate-600">
                    {{ $locale === 'en' ? 'Plenary Session (08:00 – 10:00) applies to all halls. On smaller screens, swipe horizontally to view all sessions.' : 'Phiên Tổng quan (08h00 – 10h00) áp dụng cho tất cả các hội trường. Trên màn hình nhỏ, vuốt ngang để xem đầy đủ các phiên.' }}
                </p>
            </div>
            <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-emerald-700" tabindex="0" role="region" aria-labelledby="hall-schedule-title"
                aria-describedby="hall-schedule-help">
                <table class="w-full min-w-[900px] text-sm text-left">
                    <caption class="sr-only">Phân bổ chuyên đề tại các hội trường ngày 19/11/2026</caption>
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col" class="px-6 py-5 font-semibold">{{ $locale === 'en' ? 'Hall' : 'Hội trường' }}</th>
                            @php
                                $sessions = $locale === 'en' ? [
                                    ['Plenary Session', '08:00 – 10:00'],
                                    ['Session 2', '10:15 – 11:30'],
                                    ['Session 3', '13:00 – 14:25'],
                                    ['Session 4', '14:40 – 16:15']
                                ] : [
                                    ['Phiên Tổng quan', '08h00 – 10h00'],
                                    ['Phiên 2', '10h15 – 11h30'],
                                    ['Phiên 3', '13h00 – 14h25'],
                                    ['Phiên 4', '14h40 – 16h15']
                                ];
                            @endphp
                            @foreach ($sessions as [$session, $time])
                                <th scope="col" class="px-4 py-5 font-semibold">
                                    <span class="block">{{ $session }}</span>
                                    <span class="block mt-1 text-xs font-normal text-emerald-100">{{ $time }}</span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($hallSchedule as $hall)
                            <tr class="odd:bg-white even:bg-slate-50 hover:bg-emerald-50/60">
                                <th scope="row" class="px-6 py-5 font-semibold text-emerald-900 whitespace-nowrap">{{ $hall[0] }}</th>
                                @foreach (array_slice($hall, 1) as $topic)
                                    <td class="px-4 py-5 text-slate-700">{{ $topic ?? '—' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Control Bar: Search & Quick Filters -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 mb-1">
                    {{ $locale === 'en' ? 'Interactive Details' : 'Chi tiết từng bài báo cáo' }}
                </span>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ $locale === 'en' ? 'Detailed Presentations by 10 Meeting Rooms' : 'Chương trình chi tiết theo 10 Phòng họp' }}
                </h3>
            </div>

            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
                <!-- Search Input -->
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input 
                        type="text" 
                        x-model="searchQuery" 
                        placeholder="{{ $locale === 'en' ? 'Search by presentation title, speaker name, institution, specialty...' : 'Tìm kiếm theo tên bài báo cáo, báo cáo viên, đơn vị, chuyên đề...' }}" 
                        class="w-full pl-11 pr-10 py-3 text-sm bg-slate-50 hover:bg-slate-100/80 focus:bg-white border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition"
                    >
                    <button 
                        type="button" 
                        x-show="searchQuery" 
                        @click="searchQuery = ''" 
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Session Select Filter -->
                <div class="flex items-center gap-2">
                    <label class="text-xs font-bold text-slate-500 uppercase whitespace-nowrap">{{ $locale === 'en' ? 'Session:' : 'Khung phiên:' }}</label>
                    <select 
                        x-model="selectedSession" 
                        class="py-2.5 px-3.5 text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 text-slate-800"
                    >
                        <option value="all">{{ $locale === 'en' ? 'All Sessions' : 'Tất cả các phiên' }}</option>
                        <option value="1">{{ $locale === 'en' ? 'Plenary Session (08:30 – 10:00)' : 'Phiên 1: Tổng quan (08h30 – 10h00)' }}</option>
                        <option value="2">{{ $locale === 'en' ? 'Session 2 (10:15 – 11:30)' : 'Phiên 2 (10h15 – 11h30)' }}</option>
                        <option value="3">{{ $locale === 'en' ? 'Session 3 (13:00 – 14:25)' : 'Phiên 3 (13h00 – 14h25)' }}</option>
                        <option value="4">{{ $locale === 'en' ? 'Session 4 (14:40 – 16:15)' : 'Phiên 4 (14h40 – 16h15)' }}</option>
                        <option value="poster">{{ $locale === 'en' ? 'Poster Presentations' : 'Báo cáo Poster' }}</option>
                    </select>
                </div>
            </div>

            <!-- Hall Filter Badges -->
            <div>
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2.5">
                    {{ $locale === 'en' ? 'Filter by Room:' : 'Lọc theo Phòng họp:' }}
                </div>
                <div class="flex flex-wrap gap-2">
                    <button 
                        type="button" 
                        @click="selectedHall = 'all'" 
                        :class="selectedHall === 'all' ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                        class="px-3.5 py-1.5 rounded-xl text-xs transition"
                    >
                        {{ $locale === 'en' ? 'All Rooms (10)' : 'Tất cả Phòng (10)' }}
                    </button>

                    @foreach($hallsData as $hall)
                    <button 
                        type="button" 
                        @click="selectedHall = '{{ $hall['id'] }}'" 
                        :class="selectedHall === '{{ $hall['id'] }}' ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-emerald-600'"
                        class="px-3 py-1.5 rounded-xl text-xs transition flex items-center gap-1.5"
                    >
                        <span>{{ $hall['name'] }}</span>
                        @if(!empty($hall['room']))
                            <span class="text-[10px] opacity-75 font-normal">({{ $hall['room'] }})</span>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Hall Program List -->
        <div class="space-y-10">
            @foreach($hallsData as $hall)
            <div 
                x-show="(selectedHall === 'all' || selectedHall === '{{ $hall['id'] }}') && hasMatchingItemsInHall({{ json_encode($hall) }})" 
                x-cloak 
                class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden"
            >
                <!-- Hall Header Banner -->
                <div class="bg-gradient-to-r from-emerald-900 to-emerald-800 text-white p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2.5">
                            <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight">{{ $hall['name'] }}</h2>
                            @if(!empty($hall['room']))
                                <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white font-semibold text-xs tracking-wide">
                                    {{ $hall['room'] }}
                                </span>
                            @endif
                        </div>
                        @if(!empty($hall['badge']))
                        <p class="text-emerald-100 text-xs sm:text-sm font-medium">
                            {{ $hall['badge'] }}
                        </p>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-700/80 text-white border border-emerald-500/30">
                            <span>📅 19/11/2026</span>
                            <span>•</span>
                            <span>08h30 – 16h15</span>
                        </span>
                    </div>
                </div>

                <!-- Sessions in this Hall -->
                <div class="divide-y divide-slate-200">
                    @foreach($hall['sessions'] as $session)
                    <div 
                        x-show="(selectedSession === 'all' || String(selectedSession) === '{{ $session['session_num'] }}') && hasMatchingItemsInSession({{ json_encode($session) }}, {{ json_encode($hall) }})"
                        class="p-6 sm:p-8 space-y-6"
                    >
                        <!-- Session Header Box -->
                        <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-start justify-between gap-4">
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-emerald-800 text-white">
                                        {{ $session['time'] }}
                                    </span>
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900">
                                        {{ $session['name'] }}
                                    </h3>
                                </div>
                                <div class="text-xs text-slate-700">
                                    <strong class="text-slate-900">{{ $locale === 'en' ? 'Chairs:' : 'Chủ tọa:' }}</strong> 
                                    <span class="text-slate-800 font-medium">{{ $session['chairs'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Session Presentations Table -->
                        <div class="overflow-x-auto rounded-xl border border-slate-200">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-100 text-slate-700 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                    <tr>
                                        <th scope="col" class="w-32 px-4 py-3.5 whitespace-nowrap">{{ $locale === 'en' ? 'Time' : 'Thời gian' }}</th>
                                        <th scope="col" class="px-5 py-3.5">{{ $locale === 'en' ? 'Presentation Title' : 'Tên bài báo cáo' }}</th>
                                        <th scope="col" class="w-72 px-5 py-3.5">{{ $locale === 'en' ? 'Speaker & Affiliation' : 'Báo cáo viên & Đơn vị' }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-800">
                                    @foreach($session['items'] as $item)
                                    <tr 
                                        x-show="matchesSearch({{ json_encode($item) }}, {{ json_encode($session) }}, {{ json_encode($hall) }})" 
                                        class="{{ !empty($item['is_break']) ? 'bg-amber-50/40 text-slate-600 italic font-medium' : 'hover:bg-emerald-50/40 transition-colors odd:bg-white even:bg-slate-50/40' }}"
                                    >
                                        <!-- Time -->
                                        <td class="px-4 py-3.5 font-bold text-emerald-800 whitespace-nowrap align-top text-xs sm:text-sm">
                                            {{ $item['time'] }}
                                        </td>

                                        <!-- Title -->
                                        <td class="px-5 py-3.5 align-top">
                                            @if(!empty($item['is_break']))
                                                <div class="flex items-center gap-2 text-amber-900 font-bold">
                                                    @if(str_contains(strtolower($item['title']), 'tea'))
                                                        <span>☕</span>
                                                    @elseif(str_contains(strtolower($item['title']), 'trưa') || str_contains(strtolower($item['title']), 'lunch'))
                                                        <span>🍽️</span>
                                                    @elseif(str_contains(strtolower($item['title']), 'thảo luận') || str_contains(strtolower($item['title']), 'discussion'))
                                                        <span>💬</span>
                                                    @elseif(str_contains(strtolower($item['title']), 'bế mạc'))
                                                        <span>🏁</span>
                                                    @endif
                                                    <span>{{ $item['title'] }}</span>
                                                </div>
                                            @else
                                                <div class="font-bold text-slate-900 leading-snug">
                                                    {{ $item['title'] }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Speaker & Org -->
                                        <td class="px-5 py-3.5 align-top">
                                            @if($item['speaker'])
                                                <div class="space-y-1">
                                                    <div class="font-bold text-emerald-950 text-xs sm:text-sm flex items-center gap-1.5">
                                                        <span class="text-emerald-700">👤</span>
                                                        <span>{{ $item['speaker'] }}</span>
                                                    </div>
                                                    @if($item['org'])
                                                        <div class="text-xs text-slate-500 leading-relaxed pl-5">
                                                            {{ $item['org'] }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-slate-400 text-xs">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                                        @endforeach

                    @if(!empty($hall['posters']))
                    <!-- Poster Presentations in this Hall -->
                    <div 
                        x-show="(selectedSession === 'all' || selectedSession === 'poster') && hasMatchingPostersInHall({{ json_encode($hall) }})"
                        class="p-6 sm:p-8 space-y-6 bg-slate-50/60"
                    >
                        <div class="bg-amber-50/90 border border-amber-200/90 rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-start justify-between gap-4">
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide bg-amber-200 text-amber-900">
                                        POSTER
                                    </span>
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900">
                                        {{ $locale === 'en' ? 'POSTER PRESENTATIONS' : 'BÁO CÁO POSTER' }}
                                    </h3>
                                </div>
                                <p class="text-xs text-slate-600">
                                    {{ $locale === 'en' ? 'Scientific research and clinical case reports displayed as Posters' : 'Các công trình nghiên cứu và báo cáo ca bệnh trưng bày Poster' }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-semibold bg-white border border-amber-200 text-amber-900 shadow-2xs">
                                    <span>📌</span>
                                    <span>{{ count($hall['posters']) }} {{ $locale === 'en' ? 'Posters' : 'bài Poster' }}</span>
                                </span>
                            </div>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-2xs">
                            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                                <thead>
                                    <tr class="bg-slate-100/90 border-b border-slate-200 text-slate-700">
                                        <th scope="col" class="px-4 py-3 font-bold w-16 text-center">STT</th>
                                        <th scope="col" class="px-5 py-3 font-bold">{{ $locale === 'en' ? 'Presentation Title' : 'Tên bài báo cáo Poster' }}</th>
                                        <th scope="col" class="px-5 py-3 font-bold w-1/3">{{ $locale === 'en' ? 'Authors & Department' : 'Tác giả & Đơn vị công tác' }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($hall['posters'] as $poster)
                                    <tr 
                                        x-show="matchesPosterSearch({{ json_encode($poster) }}, {{ json_encode($hall) }})"
                                        class="hover:bg-amber-50/40 transition"
                                    >
                                        <td class="px-4 py-3.5 align-top text-center font-bold text-amber-800">
                                            {{ $poster['id'] }}
                                        </td>
                                        <td class="px-5 py-3.5 align-top">
                                            <div class="font-bold text-slate-900 leading-snug">
                                                {{ $poster['title'] }}
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 align-top">
                                            @if(!empty($poster['speaker']))
                                            <div class="space-y-1">
                                                <div class="font-bold text-emerald-950 text-xs sm:text-sm flex items-center gap-1.5">
                                                    <span class="text-emerald-700">👤</span>
                                                    <span>{{ $poster['speaker'] }}</span>
                                                </div>
                                                @if(!empty($poster['org']))
                                                <div class="text-xs text-slate-500 leading-relaxed pl-5">
                                                    {{ $poster['org'] }}
                                                </div>
                                                @endif
                                            </div>
                                            @else
                                                <span class="text-slate-400 text-xs">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Bottom Action CTA -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm text-center space-y-4">
            <h3 class="text-lg font-bold text-slate-900">
                {{ $locale === 'en' ? 'Ready to join the Conference?' : 'Đăng ký tham gia Hội nghị ngay hôm nay' }}
            </h3>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto">
                {{ $locale === 'en' ? 'Online registration is open for all healthcare professionals, researchers, and students.' : 'Cổng đăng ký trực tuyến đang mở dành cho tất cả bác sĩ, chuyên gia, cán bộ y tế và học viên trên toàn quốc.' }}
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary">
                    {{ __('conference.cta.register_now') }} →
                </a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'invitation']) }}" class="btn-secondary">
                    {{ __('conference.nav.invitation') }}
                </a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="btn-secondary">
                    {{ __('conference.nav.venue') }}
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
