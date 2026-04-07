# CRM Test Project

## Deploy

### 1. Clone the project from Git
git clone https://github.com/Luke1048/crm-test.git

### 2. Configure the database and start Docker
Create the `.env` file using `.env.example` as a reference.  
Then start Docker and build the containers:
docker-compose up -d --build

### 3. Install PHP dependencies
docker exec -it test_crm_php8_4 composer install

### 4. Generate the application key
docker exec -it test_crm_php8_4 php artisan key:generate

### 5. Run migrations
docker exec -it test_crm_php8_4 php artisan migrate

### 6. Seed the database
docker exec -it test_crm_php8_4 php artisan db:seed

**Test Data Included**
After seeding, the database contains sample data for testing:

- Users:
    - test.admin@test.com / password: password – Role: **admin**
    - test.manager@test.com / password: password – Role: **manager**

Example usage of the widget iframe:

```html
<iframe src="{{ url('DOMAIN/widget') }}" width="320" height="400" style="border:0;"></iframe>
```

Here, DOMAIN should be replaced with your APP_URL from the .env file

**API example**

Create ticket

curl -X POST "https://yourdomain.com/tickets" \
-H "Accept: application/json" \
-F "email=john.doe@example.com" \
-F "subject=My ticket subject" \
-F "message=This is the message body" \
-F "attachments[]=@/path/to/file1.txt" \
-F "attachments[]=@/path/to/file2.jpg"

Response:

{
    "status": "success",
    "message": "Ticket successfully created",
    "ticket": {
    "id": 123,
    "customer": {
        "id": 10,
        "name": "John Doe",
        "email": "john.doe@example.com",
        "created_at": "2026-04-01T09:30:00",
        "updated_at": "2026-04-05T14:20:00"
    },
    "subject": "My ticket subject",
    "message": "This is the message body",
    "status": "new",
    "answered_at": null,
    "created_at": "2026-04-07T11:45:00",
    "updated_at": "2026-04-07T11:45:00",
    "files": [
        {
            "ticket_id": 123,
            "name": "file1.txt",
            "url": "https://yourdomain.com/storage/files/file1.txt",
            "created_at": "2026-04-07T11:45:10",
            "updated_at": "2026-04-07T11:45:10"
        },
        {
            "ticket_id": 123,
            "name": "file2.jpg",
            "url": "https://yourdomain.com/storage/files/file2.jpg",
            "created_at": "2026-04-07T11:45:12",
            "updated_at": "2026-04-07T11:45:12"
        }
    ]
}

**API Documentation**

You can view the interactive API documentation (Swagger UI) at:
http://yourdomain.com/api/documentation

**API Documentation**

You can view the interactive API documentation (Swagger UI) at:
http://yourdomain.com/api/documentation


## 📦 Tech Stack
- PHP 8.4
- Laravel 12
- Docker / Docker Compose
- MySQL

## ⚡ Useful Commands
- Start containers: docker-compose up -d
- Stop containers: docker-compose down
- Restart containers: docker-compose restart
- Run tests: docker exec -it test_crm_php8_4 php artisan test tests/Feature/TicketServiceTest.php

> The project is now ready for local development and testing.
