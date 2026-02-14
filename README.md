# 🩺 MediKonsul — Online Health Consultation & Booking Platform

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Blade](https://img.shields.io/badge/Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/docs/blade)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

**MediKonsul** is a web-based **health consultation booking application** built with Laravel.  
The platform allows patients to book consultation sessions easily while enabling administrators to manage schedules, booking availability, and consultation durations efficiently.

---

## ✨ Key Features

### 👤 Patient Side
- **Online Consultation Booking**  
  Users can book available consultation slots.

- **Email Notification System**  
  Booking confirmation is automatically sent to the user's email.

- **Simple & Responsive Interface**  
  Clean UI for seamless booking experience.

---

### 🛠️ Admin Panel
- **Manage Consultation Duration**  
  Admin can adjust consultation session duration.

- **Control Booking Availability**  
  Admin can open or close booking periods dynamically.

- **Schedule Management**  
  Modify available consultation time slots.

- **Booking Monitoring**  
  View and manage incoming consultation requests.

---

## 🛠️ Tech Stack

### Backend
- Laravel (MVC Architecture)
- PHP
- MySQL

### Frontend
- Blade Template Engine
- TailwindCss

### Email Service
- Laravel Mail (SMTP Configuration)

---

## 📂 Project Structure

```
medikonsul/
├── app/                    
├── bootstrap/              
├── config/                 
├── database/               
├── public/                 
├── resources/
│   ├── views/              
│   └── css/js              
├── routes/                 
├── storage/                
├── .env                    
└── README.md               
```

---

## 🚀 Getting Started

### 1️⃣ Clone Repository
```bash
git clone https://github.com/yuanthio/medikonsul.git
cd medikonsul
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
```

### 3️⃣ Setup Environment
Copy `.env.example` to `.env`
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

---

### 4️⃣ Configure Database (.env)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medikonsul
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5️⃣ Configure Email (SMTP)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="MediKonsul"
```

> ⚠️ Make sure to enable App Password if using Gmail.

---

### 6️⃣ Run Migration
```bash
php artisan migrate
```

(Optional: if using seeders)
```bash
php artisan db:seed
```

---

### 7️⃣ Run Development Server
```bash
php artisan serve
```

Open in browser:
```
http://127.0.0.1:8000
```

---

## 🎯 Project Goals

MediKonsul is built to demonstrate:

- Clean Laravel MVC Architecture
- Dynamic booking management system
- Email notification integration
- Admin-controlled scheduling logic
- Real-world healthcare service simulation

---

## 📌 Future Improvements
  
- Doctor profile management  
- Multi-role authentication (Admin and Patient)  
- Dashboard analytics  
- Calendar-based booking visualization  

---

## 👨‍💻 Author

**Yuanthio Virly**  
Full-Stack Developer | Laravel Enthusiast  

---

If you find this project helpful or interesting, feel free to ⭐ the repository!
