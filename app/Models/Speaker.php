<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getLocalizedBioAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'vi' && !empty($this->bio_vi)) {
            return $this->bio_vi;
        }
        return $this->bio_en ?? $this->bio_vi ?? '';
    }

    public function getLocalizedTitleAttribute(): string
    {
        if (app()->getLocale() !== 'en') {
            return $this->title ?? '';
        }

        $map = [
            'Giám đốc Bệnh viện Hữu nghị Việt Đức' => 'Director, Viet Duc University Hospital',
            'Trưởng khoa Ngoại Tiêu hóa & Ghép tạng' => 'Head of Digestive & Oncological Surgery',
            'Giám đốc Trung tâm Y học Di truyền Lâm sàng' => 'Director of Center for Clinical Genetics',
            'Trưởng Ban Thư ký Chuyên môn Hội nghị' => 'Head of Scientific Secretariat',
        ];

        return $map[$this->title] ?? $this->title ?? '';
    }

    public function getLocalizedAffiliationAttribute(): string
    {
        if (app()->getLocale() !== 'en') {
            return $this->affiliation ?? '';
        }

        $map = [
            'Bệnh viện Hữu nghị Việt Đức' => 'Viet Duc University Hospital',
            'Bệnh viện Đại học Amiens-Picardie, Pháp' => 'Amiens-Picardie University Hospital, France',
            'Đại học Keio, Tokyo, Nhật Bản' => 'Keio University School of Medicine, Tokyo, Japan',
        ];

        return $map[$this->affiliation] ?? $this->affiliation ?? '';
    }

    public function getLocalizedTopicAttribute(): string
    {
        if (app()->getLocale() !== 'en') {
            return $this->topic ?? '';
        }

        $map = [
            'Khai mạc & Định hướng phát triển Ngoại khoa Việt Nam trong kỷ nguyên mới' => 'Opening Keynote: Strategic Developments in Vietnamese Surgery in the Modern Era',
            'Những tiến bộ mới nhất trong Phẫu thuật Ghép gan và Phẫu thuật Robot đường tiêu hóa' => 'Recent Breakthroughs in Liver Transplantation and Robotic GI Surgery',
            'Ứng dụng Y học chính xác và Giải trình tự Gen trong Phẫu thuật Nhi và Bệnh lý phức tạp' => 'Precision Medicine & Genomic Sequencing in Pediatric Surgery and Complex Diseases',
            'Tổng quan các tiến bộ kỹ thuật trong Phẫu thuật Tạo hình - Vi phẫu tại BV Việt Đức' => 'Advances and Technical Innovations in Plastic & Reconstructive Microsurgery at VDUH',
        ];

        return $map[$this->topic] ?? $this->topic ?? '';
    }
}
