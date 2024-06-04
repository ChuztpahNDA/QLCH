# Yêu cầu: có xampp hoặc serve ảo tương đương

# Clone source code
git clone https://github.com/ChuztpahNDA/QLCH.git

# Chạy lệnh setup
- composer install
- npm install

# khởi chạy xampp
- php artisan migrate
- nhập yes -> ente

- rename file .env.example  thành .env
- php artisan db:seed
- php artisan passport:client --personal => nhấn enter để tiếp tục
- php artisan passport:keys

# chạy lệnh để khởi động phần mềm
- php artisan serve
- mở 1 terminal khác chạy
- npm run dev

# Tài khoản Login
- TK: admin@example.com
- MK: 12345678
