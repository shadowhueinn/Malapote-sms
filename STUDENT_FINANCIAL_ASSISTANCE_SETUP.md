# Student Financial Assistance System

## Folder Structure

```text
frontend/
  src/
    components/
    context/
    lib/
    pages/
  index.html
  package.json
  tailwind.config.js

backend/
  src/
    config/
    controllers/
    middleware/
    models/
    routes/
    server.js
  uploads/
  package.json
```

## Features Included

- Student sign up
- Student login
- JWT authentication
- Password hashing with bcrypt
- Full student profile schema
- Profile dashboard
- Profile update page
- 2x2 ID picture upload
- Government-style grouped form layout
- Field-level validation messages
- Local browser draft auto-save on registration form

## Run Instructions

### 1. Install dependencies

Backend:

```bash
cd backend
npm install
```

Frontend:

```bash
cd frontend
npm install
```

### 2. Configure environment files

Backend:

```bash
cp .env.example .env
```

Frontend:

```bash
cp .env.example .env
```

Update backend `.env` with your MongoDB connection string and JWT secret.

### 3. Start the backend

```bash
cd backend
npm run dev
```

### 4. Start the frontend

```bash
cd frontend
npm run dev
```

### 5. Open the app

Frontend:

`http://localhost:5173`

Backend API:

`http://localhost:5000`

## API Routes

- `POST /api/auth/register`
- `POST /api/auth/login`
- `GET /api/user/profile`
- `PUT /api/user/update`
