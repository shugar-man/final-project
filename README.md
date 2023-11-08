# Final Project
เว็บแอปพลิเคชันออนไลน์ เป็นพื้นที่สำหรับให้ผู้คนที่เข้ามาใช้งานแสดงรูปภาพ/ผลงานต่างๆ มีระบบ กด Like,Comment,Follow และ Report post ของ Admin 
## Member
ชื่อกลุ่ม harry shucal
- [shugar-man](https://github.com/shugar-man) นาย กฤษณะ แก้วพวงงาม (โดม) 6310403923
- [Thapdecha](https://github.com/Thapdecha) นาย ทัพพ์เดชา โกเมนเอก (โจ) 6410406606
- [carry212121](https://github.com/carry212121) นาย หฤษฎ์ มงคลประดิษฐ (แฮร์รี่) 6410401191
#### โปรเจคนี้เป็นส่วนหนึ่งของวิชา Web Technology and Web Services (01418442)
## Installation
To get started with the project, follow these steps:
### Clone the repository to your local machine:
`git clone https://github.com/shugar-man/final-project.git`
### Change your working directory to the backend project folder:
`cd final-project/backend-project`
### Installing Composer Dependencies
`docker run --rm \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs`
### Create an alias for Laravel Sail:
- For wsl
`echo "alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'" >> ~/.bashrc`
- For zsh
`echo "alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'" >> ~/.zshrc`
### Create a .env file
`cp .env.example .env`
### Run all container
`sail up -d`
### Generate an application key in .env:
`sail artisan key:generate`
### Run database migrations and seeders to set up the database:
`sail artisan migrate:fresh --seed`
### Link Storage
`sail artisan storage:link`
#### Change your working directory to the frontend project folder:
`cd final-project/frontend-project`
### Install npm:
`npm install`
### Start frontend server:
`npm run dev`
#### Then access to http://localhost:3000
## Users Examples
| Email | Password | Role |
| -------- | -------- | -------- |
| user01@example.com | password | Member |
| user02@example.com | password | Member |
| admin@example.com | admin | Admin |
- Member คือสมาชิกที่ลงทะเบียนแล้ว
- Admin คือเจ้าของเว็ปไซด์ ดูแลระบบต่างๆ รวมถึง ระบบ report และ สามารถลบ post ที่ไม่เหมาะสมได้