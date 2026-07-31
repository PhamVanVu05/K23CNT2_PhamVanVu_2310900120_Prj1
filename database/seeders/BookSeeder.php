<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $descTemplate = 'Đây là cuốn sách tuyệt vời mang lại nhiều kiến thức bổ ích. Nội dung được biên soạn kỹ lưỡng, phù hợp với nhiều độc giả. Mua ngay tại Trí Tuệ Bookstore!';

        $books = [
            // ==========================================
            // DANH MỤC 1: SÁCH KHOA HỌC VÀ LỊCH SỬ
            // ==========================================
            [
                'category_id' => 1, 'title' => 'Sapiens - Lược sử loài người', 'author' => 'Yuval Noah Harari', 'price' => 195000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/31343C/FFF?font=roboto&text=Sapiens', 
                'description' => 'Cuốn sách khám phá lịch sử tiến hóa của loài người từ thủa sơ khai.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 1, 'title' => 'Lược sử thời gian', 'author' => 'Stephen Hawking', 'price' => 135000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/31343C/FFF?font=roboto&text=Luoc+su+thoi+gian', 
                'description' => 'Kiệt tác về vũ trụ học giúp chúng ta hiểu về thời gian, không gian và các lỗ đen.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 1, 'title' => 'Nguồn gốc các loài', 'author' => 'Charles Darwin', 'price' => 150000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/31343C/FFF?font=roboto&text=Nguon+goc+cac+loai', 
                'description' => 'Nền tảng của sinh học tiến hóa, giải thích sự phát triển của sự sống.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 1, 'title' => 'Súng, Vi trùng và Thép', 'author' => 'Jared Diamond', 'price' => 210000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/31343C/FFF?font=roboto&text=Sung+Vi+Trung+Thep', 
                'description' => 'Giải mã định mệnh của các xã hội loài người trong 13.000 năm qua.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 1, 'title' => 'Vũ trụ', 'author' => 'Carl Sagan', 'price' => 180000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/31343C/FFF?font=roboto&text=Vu+Tru', 
                'description' => 'Hành trình vĩ đại khám phá sự rộng lớn bao la của vũ trụ.', 'created_at' => $now, 'updated_at' => $now
            ],

            // ==========================================
            // DANH MỤC 2: SÁCH NGOẠI NGỮ
            // ==========================================
            [
                'category_id' => 2, 'title' => 'Hack Não 1500 Từ Tiếng Anh', 'author' => 'Nguyễn Văn Hiệp', 'price' => 395000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/0056b3/FFF?font=roboto&text=Hack+Nao+1500', 
                'description' => 'Phương pháp học từ vựng tiếng Anh qua âm thanh tương tự và truyện chêm.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 2, 'title' => 'IELTS Cambridge 18', 'author' => 'Cambridge University', 'price' => 150000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/0056b3/FFF?font=roboto&text=IELTS+Cam+18', 
                'description' => 'Bộ đề thi thật IELTS mới nhất từ Cambridge giúp bạn luyện thi hiệu quả.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 2, 'title' => 'English Grammar in Use', 'author' => 'Raymond Murphy', 'price' => 200000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/0056b3/FFF?font=roboto&text=Grammar+in+Use', 
                'description' => 'Cuốn sách ngữ pháp tiếng Anh kinh điển dành cho người học tự học.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 2, 'title' => 'Destination B1 & B2', 'author' => 'Malcolm Mann', 'price' => 180000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/0056b3/FFF?font=roboto&text=Destination+B1+B2', 
                'description' => 'Tài liệu cung cấp từ vựng và ngữ pháp nền tảng cho cấp độ B1, B2.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 2, 'title' => 'Mindset for IELTS', 'author' => 'Cambridge', 'price' => 250000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/0056b3/FFF?font=roboto&text=Mindset+IELTS', 
                'description' => 'Bộ sách toàn diện giúp định hình tư duy làm bài thi IELTS.', 'created_at' => $now, 'updated_at' => $now
            ],

            // ==========================================
            // DANH MỤC 3: SÁCH THIẾU NHI
            // ==========================================
            [
                'category_id' => 3, 'title' => 'Dế Mèn Phiêu Lưu Ký', 'author' => 'Tô Hoài', 'price' => 55000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/28a745/FFF?font=roboto&text=De+Men', 
                'description' => 'Tác phẩm văn học thiếu nhi kinh điển của Việt Nam về những chuyến phiêu lưu.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 3, 'title' => 'Hoàng Tử Bé', 'author' => 'Antoine de Saint-Exupéry', 'price' => 65000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/28a745/FFF?font=roboto&text=Hoang+Tu+Be', 
                'description' => 'Câu chuyện đầy triết lý nhân sinh ẩn dưới vỏ bọc một truyện cổ tích.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 3, 'title' => 'Harry Potter và Hòn Đá Phù Thủy', 'author' => 'J.K. Rowling', 'price' => 120000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/28a745/FFF?font=roboto&text=Harry+Potter', 
                'description' => 'Khởi đầu cho hành trình thế giới phép thuật đầy màu sắc.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 3, 'title' => 'Chuyện con mèo dạy hải âu bay', 'author' => 'Luis Sepúlveda', 'price' => 75000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/28a745/FFF?font=roboto&text=Meo+Day+Hai+Au', 
                'description' => 'Câu chuyện cảm động về tình yêu thương vô điều kiện và giữ lời hứa.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 3, 'title' => 'Cây cam ngọt của tôi', 'author' => 'José Mauro', 'price' => 85000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/28a745/FFF?font=roboto&text=Cay+Cam+Ngot', 
                'description' => 'Một tác phẩm chạm đến trái tim về tuổi thơ dữ dội và ngọt ngào.', 'created_at' => $now, 'updated_at' => $now
            ],

            // ==========================================
            // DANH MỤC 4: SÁCH KINH TẾ
            // ==========================================
            [
                'category_id' => 4, 'title' => 'Cha Giàu Cha Nghèo', 'author' => 'Robert Kiyosaki', 'price' => 110000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/dc3545/FFF?font=roboto&text=Cha+Giau', 
                'description' => 'Bài học vỡ lòng về quản lý tài chính cá nhân và tư duy làm giàu.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 4, 'title' => 'Người Giàu Có Nhất Thành Babylon', 'author' => 'George S. Clason', 'price' => 85000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/dc3545/FFF?font=roboto&text=Babylon', 
                'description' => 'Những nguyên lý tài chính cổ xưa vẫn còn nguyên giá trị ở thời hiện đại.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 4, 'title' => 'Tư Duy Nhanh Và Chậm', 'author' => 'Daniel Kahneman', 'price' => 185000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/dc3545/FFF?font=roboto&text=Tu+Duy', 
                'description' => 'Phân tích hai hệ thống tư duy chi phối quyết định của con người.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 4, 'title' => 'Nhà Đầu Tư Thông Minh', 'author' => 'Benjamin Graham', 'price' => 220000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/dc3545/FFF?font=roboto&text=Nha+Dau+Tu', 
                'description' => 'Cuốn sách gối đầu giường cho bất kỳ ai bước chân vào thị trường chứng khoán.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 4, 'title' => 'Bí mật tư duy triệu phú', 'author' => 'T. Harv Eker', 'price' => 115000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/dc3545/FFF?font=roboto&text=Tu+Duy+Trieu+Phu', 
                'description' => 'Lập trình lại kế hoạch tài chính trong tâm thức của bạn.', 'created_at' => $now, 'updated_at' => $now
            ],

            // ==========================================
            // DANH MỤC 5: SÁCH PHÁT TRIỂN BẢN THÂN
            // ==========================================
            [
                'category_id' => 5, 'title' => 'Thói Quen Nguyên Tử', 'author' => 'James Clear', 'price' => 165000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/ffc107/000?font=roboto&text=Atomic+Habits', 
                'description' => 'Thay đổi nhỏ tạo ra khác biệt lớn thông qua việc xây dựng thói quen.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 5, 'title' => 'Nghệ Thuật Tinh Tế', 'author' => 'Mark Manson', 'price' => 125000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/ffc107/000?font=roboto&text=Nghe+Thuat', 
                'description' => 'Cách tiếp cận khác biệt để sống một cuộc đời ý nghĩa và tập trung vào điều quan trọng.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 5, 'title' => 'Đắc Nhân Tâm', 'author' => 'Dale Carnegie', 'price' => 95000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/ffc107/000?font=roboto&text=Dac+Nhan+Tam', 
                'description' => 'Nghệ thuật thu phục lòng người và giao tiếp hiệu quả.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 5, 'title' => 'Đời Ngắn Đừng Ngủ Dài', 'author' => 'Robin Sharma', 'price' => 80000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/ffc107/000?font=roboto&text=Doi+Ngan', 
                'description' => 'Những bài học truyền cảm hứng giúp bạn trân trọng thời gian.', 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'category_id' => 5, 'title' => 'Không Diệt Không Sinh', 'author' => 'Thích Nhất Hạnh', 'price' => 110000, 
                'is_active' => 1, 'image' => 'https://placehold.co/400x600/ffc107/000?font=roboto&text=Khong+Diet', 
                'description' => 'Góc nhìn sâu sắc về sự sống, cái chết và sự bình yên trong tâm hồn.', 'created_at' => $now, 'updated_at' => $now
            ]
        ];

        DB::table('books')->insert($books);
    }
}