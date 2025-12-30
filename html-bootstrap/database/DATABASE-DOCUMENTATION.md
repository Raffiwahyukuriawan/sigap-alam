# SIGAP ALAM - Database Design & Data Flow Documentation

## 📊 Entity Relationship Diagram (ERD)

```
┌──────────────────────┐
│      users           │
├──────────────────────┤
│ id (PK)              │
│ name                 │
│ email (UNIQUE)       │
│ password             │
│ role                 │◄────────┐
│ photo                │         │
│ created_at           │         │
│ updated_at           │         │
└──────────────────────┘         │
         │                       │
         │ 1:N                   │ 1:N (admin)
         │                       │
         ▼                       │
┌──────────────────────────┐    │
│     articles             │    │
├──────────────────────────┤    │
│ id (PK)                  │    │
│ user_id (FK) ────────────┘    │
│ disaster_category_id (FK)     │
│ title                    │    │
│ slug (UNIQUE)            │    │
│ content                  │    │
│ cover_image              │    │
│ status                   │    │
│ published_at             │    │
│ created_at               │    │
│ updated_at               │    │
└──────────────────────────┘    │
         │                       │
         │ 1:N                   │
         │                       │
         ├────────────────┬──────┴──────────────┐
         ▼                ▼                     ▼
┌──────────────────┐ ┌──────────────────┐ ┌──────────────────────┐
│article_comments  │ │article_approvals │ │disaster_categories   │
├──────────────────┤ ├──────────────────┤ ├──────────────────────┤
│ id (PK)          │ │ id (PK)          │ │ id (PK)              │
│ article_id (FK)  │ │ article_id (FK)  │ │ name                 │
│ name             │ │ admin_id (FK) ───┘ │ icon                 │
│ email            │ │ status           │ │ description          │
│ comment          │ │ note             │ │ created_at           │
│ created_at       │ │ created_at       │ │ updated_at           │
└──────────────────┘ └──────────────────┘ └──────────────────────┘
                                                    │
                                                    │ 1:N
                                                    │
                                                    ▼
                                          ┌──────────────────────┐
                                          │  prevention_tips     │
                                          ├──────────────────────┤
                                          │ id (PK)              │
                                          │ disaster_category_id │
                                          │ title                │
                                          │ content              │
                                          │ created_at           │
                                          │ updated_at           │
                                          └──────────────────────┘
```

---

## 🔄 Detailed Data Flow Diagram

### 1. User Authentication Flow

```
┌─────────────┐
│   Visitor   │
└──────┬──────┘
       │
       ├──► Guest: Browse articles, view disasters, add comments
       │
       ├──► Login/Register
       │         │
       │         ▼
       │    ┌──────────────────────────────────────┐
       │    │   Authentication (Laravel Auth)       │
       │    └──────────┬──────────────────┬────────┘
       │               │                  │
       │               │                  │
       ▼               ▼                  ▼
  ┌─────────┐    ┌──────────┐      ┌─────────┐
  │  User   │    │Contributor│      │  Admin  │
  └─────────┘    └──────────┘      └─────────┘
```

### 2. Article Lifecycle Flow

```
┌────────────────────────────────────────────────────────────────┐
│                    ARTICLE LIFECYCLE                            │
└────────────────────────────────────────────────────────────────┘

┌──────────────┐
│ Contributor  │
│   Login      │
└──────┬───────┘
       │
       ▼
┌──────────────────┐
│ Create Article   │
│ - Title          │        ┌───────────────┐
│ - Category       │◄───────┤disaster_cat.. │
│ - Content        │        └───────────────┘
│ - Cover Image    │
└──────┬───────────┘
       │
       ├──────────► Save as Draft (status: draft)
       │                    │
       │                    ▼
       │            ┌────────────────┐
       │            │ Can edit later │
       │            └────────────────┘
       │
       └──────────► Submit for Review (status: pending)
                            │
                            ▼
                   ┌─────────────────┐
                   │ Admin Dashboard │
                   │ Pending Articles│
                   └────────┬────────┘
                            │
                            ├──────► Approve
                            │           │
                            │           ▼
                            │   ┌──────────────────┐
                            │   │ status: published │
                            │   │ published_at: NOW │
                            │   └────────┬──────────┘
                            │            │
                            │            ▼
                            │   ┌──────────────────┐
                            │   │article_approvals │
                            │   │ status: approved │
                            │   │ admin_id         │
                            │   └────────┬──────────┘
                            │            │
                            │            ▼
                            │   ┌──────────────────┐
                            │   │ Visible to Users │
                            │   └──────────────────┘
                            │
                            └──────► Reject
                                       │
                                       ▼
                               ┌──────────────────┐
                               │ status: rejected  │
                               └────────┬──────────┘
                                        │
                                        ▼
                               ┌──────────────────┐
                               │article_approvals │
                               │ status: rejected  │
                               │ note: "Reason"    │
                               │ admin_id          │
                               └────────┬──────────┘
                                        │
                                        ▼
                               ┌──────────────────┐
                               │ Notify Contributor│
                               │ Can edit & resubmit│
                               └──────────────────┘
```

### 3. Comment System Flow

```
┌──────────────┐
│   Article    │
│  (Published) │
└──────┬───────┘
       │
       ▼
┌──────────────────┐
│   User Reads     │
│    Article       │
└──────┬───────────┘
       │
       ▼
┌──────────────────┐      ┌────────────────────┐
│  Add Comment     │──────►│article_comments    │
│  - Name          │      │ article_id (FK)    │
│  - Email (opt)   │      │ name               │
│  - Comment       │      │ email              │
└──────────────────┘      │ comment            │
                          │ created_at         │
                          └────────────────────┘
                                   │
                                   ▼
                          ┌────────────────────┐
                          │Display in Article  │
                          │  Detail Page       │
                          └────────────────────┘
```

---

## 📋 Database Tables Detailed Specification

### Table: `users`

| Column     | Type         | Constraints              | Description                    |
|------------|--------------|--------------------------|--------------------------------|
| id         | BIGINT(20)   | PK, AUTO_INCREMENT       | Unique user identifier         |
| name       | VARCHAR(255) | NOT NULL                 | User full name                 |
| email      | VARCHAR(255) | NOT NULL, UNIQUE         | User email (for login)         |
| password   | VARCHAR(255) | NOT NULL                 | Hashed password                |
| role       | ENUM         | DEFAULT 'user'           | user, contributor, admin       |
| photo      | VARCHAR(255) | NULL                     | Profile photo path             |
| created_at | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Record creation time           |
| updated_at | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Last update time               |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE KEY: `email`
- INDEX: `role`

---

### Table: `disaster_categories`

| Column      | Type         | Constraints              | Description                    |
|-------------|--------------|--------------------------|--------------------------------|
| id          | BIGINT(20)   | PK, AUTO_INCREMENT       | Unique category identifier     |
| name        | VARCHAR(255) | NOT NULL                 | Disaster name (e.g., Banjir)   |
| icon        | VARCHAR(255) | NULL                     | Icon identifier (Bootstrap)    |
| description | TEXT         | NULL                     | Category description           |
| created_at  | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Record creation time           |
| updated_at  | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Last update time               |

**Indexes:**
- PRIMARY KEY: `id`
- INDEX: `name`

**Sample Data:**
```sql
INSERT INTO disaster_categories (name, icon, description) VALUES
('Banjir', 'droplets', 'Peristiwa tergenangnya daratan...'),
('Gempa Bumi', 'alert-triangle', 'Getaran atau guncangan...'),
('Tsunami', 'waves', 'Gelombang laut yang sangat besar...'),
('Kebakaran Hutan', 'flame', 'Bencana yang merusak ekosistem...'),
('Tanah Longsor', 'mountain', 'Perpindahan material pembentuk lereng...'),
('Badai', 'wind', 'Gangguan atmosfer dengan angin kencang...'),
('Kekeringan', 'cloud-rain', 'Kekurangan pasokan air...'),
('Gunung Meletus', 'zap', 'Keluarnya magma dan abu vulkanik...');
```

---

### Table: `articles`

| Column                | Type         | Constraints              | Description                    |
|-----------------------|--------------|--------------------------|--------------------------------|
| id                    | BIGINT(20)   | PK, AUTO_INCREMENT       | Unique article identifier      |
| user_id               | BIGINT(20)   | FK, NOT NULL             | Author (contributor) ID        |
| disaster_category_id  | BIGINT(20)   | FK, NOT NULL             | Associated disaster category   |
| title                 | VARCHAR(255) | NOT NULL                 | Article title                  |
| slug                  | VARCHAR(255) | NOT NULL, UNIQUE         | URL-friendly identifier        |
| content               | TEXT         | NOT NULL                 | Article content (HTML/Markdown)|
| cover_image           | VARCHAR(255) | NULL                     | Cover image path               |
| status                | ENUM         | DEFAULT 'draft'          | draft, pending, published, rejected|
| published_at          | TIMESTAMP    | NULL                     | Publication timestamp          |
| created_at            | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Record creation time           |
| updated_at            | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Last update time               |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE KEY: `slug`
- FOREIGN KEY: `user_id` → `users(id)` ON DELETE CASCADE
- FOREIGN KEY: `disaster_category_id` → `disaster_categories(id)` ON DELETE CASCADE
- INDEX: `status`, `user_id`, `disaster_category_id`

**Status Values:**
- `draft`: Artikel masih dalam draft, belum dikirim untuk review
- `pending`: Artikel telah dikirim dan menunggu persetujuan admin
- `published`: Artikel telah disetujui dan dipublikasikan
- `rejected`: Artikel ditolak oleh admin

---

### Table: `article_comments`

| Column     | Type         | Constraints              | Description                    |
|------------|--------------|--------------------------|--------------------------------|
| id         | BIGINT(20)   | PK, AUTO_INCREMENT       | Unique comment identifier      |
| article_id | BIGINT(20)   | FK, NOT NULL             | Associated article             |
| name       | VARCHAR(255) | NOT NULL                 | Commenter name                 |
| email      | VARCHAR(255) | NULL                     | Commenter email (optional)     |
| comment    | TEXT         | NOT NULL                 | Comment content                |
| created_at | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Comment timestamp              |

**Indexes:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `article_id` → `articles(id)` ON DELETE CASCADE
- INDEX: `article_id`

**Notes:**
- Comments can be posted without authentication (guest comments)
- Email is optional for privacy

---

### Table: `prevention_tips`

| Column                | Type         | Constraints              | Description                    |
|-----------------------|--------------|--------------------------|--------------------------------|
| id                    | BIGINT(20)   | PK, AUTO_INCREMENT       | Unique tip identifier          |
| disaster_category_id  | BIGINT(20)   | FK, NOT NULL             | Associated disaster category   |
| title                 | VARCHAR(255) | NOT NULL                 | Tip title                      |
| content               | TEXT         | NOT NULL                 | Tip content                    |
| created_at            | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Record creation time           |
| updated_at            | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Last update time               |

**Indexes:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `disaster_category_id` → `disaster_categories(id)` ON DELETE CASCADE
- INDEX: `disaster_category_id`

---

### Table: `article_approvals`

| Column     | Type         | Constraints              | Description                    |
|------------|--------------|--------------------------|--------------------------------|
| id         | BIGINT(20)   | PK, AUTO_INCREMENT       | Unique approval identifier     |
| article_id | BIGINT(20)   | FK, NOT NULL             | Associated article             |
| admin_id   | BIGINT(20)   | FK, NOT NULL             | Admin who reviewed             |
| status     | ENUM         | NOT NULL                 | approved, rejected             |
| note       | TEXT         | NULL                     | Rejection reason or feedback   |
| created_at | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP| Approval timestamp             |

**Indexes:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `article_id` → `articles(id)` ON DELETE CASCADE
- FOREIGN KEY: `admin_id` → `users(id)` ON DELETE CASCADE
- INDEX: `article_id`, `admin_id`

**Usage:**
- Track approval/rejection history
- Store admin feedback for rejected articles
- Multiple approvals can exist for one article (if resubmitted)

---

## 🔐 Role-Based Access Control (RBAC)

### User Roles & Permissions

| Feature                      | User | Contributor | Admin |
|------------------------------|------|-------------|-------|
| View published articles      | ✅   | ✅          | ✅    |
| View disaster categories     | ✅   | ✅          | ✅    |
| Add comments                 | ✅   | ✅          | ✅    |
| Create article               | ❌   | ✅          | ✅    |
| Edit own article             | ❌   | ✅          | ✅    |
| Delete own article           | ❌   | ✅          | ✅    |
| Submit article for review    | ❌   | ✅          | ✅    |
| Approve/Reject articles      | ❌   | ❌          | ✅    |
| Manage disaster categories   | ❌   | ❌          | ✅    |
| Manage users                 | ❌   | ❌          | ✅    |
| View all statistics          | ❌   | ❌          | ✅    |

---

## 📊 Sample Queries

### Get published articles with author and category
```sql
SELECT 
    a.id,
    a.title,
    a.slug,
    a.content,
    a.cover_image,
    a.published_at,
    u.name AS author_name,
    dc.name AS category_name,
    COUNT(ac.id) AS comment_count
FROM articles a
JOIN users u ON a.user_id = u.id
JOIN disaster_categories dc ON a.disaster_category_id = dc.id
LEFT JOIN article_comments ac ON a.id = ac.article_id
WHERE a.status = 'published'
GROUP BY a.id
ORDER BY a.published_at DESC;
```

### Get pending articles for admin review
```sql
SELECT 
    a.id,
    a.title,
    a.created_at,
    u.name AS author_name,
    dc.name AS category_name
FROM articles a
JOIN users u ON a.user_id = u.id
JOIN disaster_categories dc ON a.disaster_category_id = dc.id
WHERE a.status = 'pending'
ORDER BY a.created_at ASC;
```

### Get article approval history
```sql
SELECT 
    aa.id,
    aa.status,
    aa.note,
    aa.created_at,
    u.name AS admin_name,
    a.title AS article_title
FROM article_approvals aa
JOIN users u ON aa.admin_id = u.id
JOIN articles a ON aa.article_id = a.id
WHERE aa.article_id = :article_id
ORDER BY aa.created_at DESC;
```

### Get contributor statistics
```sql
SELECT 
    u.id,
    u.name,
    COUNT(a.id) AS total_articles,
    SUM(CASE WHEN a.status = 'published' THEN 1 ELSE 0 END) AS published_count,
    SUM(CASE WHEN a.status = 'pending' THEN 1 ELSE 0 END) AS pending_count,
    SUM(CASE WHEN a.status = 'draft' THEN 1 ELSE 0 END) AS draft_count
FROM users u
LEFT JOIN articles a ON u.id = a.user_id
WHERE u.role = 'contributor'
GROUP BY u.id;
```

---

## 🛡️ Security Considerations

### 1. Authentication & Authorization
- Use Laravel's built-in authentication
- Hash passwords with bcrypt
- Implement middleware for role checking
- CSRF protection on all forms

### 2. Input Validation
- Validate all user inputs
- Sanitize HTML content (XSS prevention)
- Validate file uploads (type, size)
- Prevent SQL injection (use prepared statements)

### 3. File Upload Security
- Validate file types (whitelist)
- Limit file sizes (max 2MB for images)
- Store uploads outside public directory
- Generate unique filenames
- Scan for malware

### 4. Data Privacy
- Don't expose user emails publicly
- Hash passwords (never store plain text)
- Implement soft deletes for sensitive data
- GDPR compliance considerations

---

## 📈 Performance Optimization

### Database Optimization
1. **Indexing**
   - Index foreign keys
   - Index frequently queried columns (status, created_at)
   - Composite indexes for complex queries

2. **Query Optimization**
   - Use eager loading (prevent N+1 queries)
   - Implement pagination
   - Cache frequently accessed data

3. **Database Structure**
   - Normalized structure (3NF)
   - Use appropriate data types
   - Set proper column lengths

### Caching Strategy
```
disaster_categories → Cache forever (rarely changes)
published_articles → Cache for 1 hour
user_stats → Cache for 5 minutes
comments → No cache (real-time)
```

---

## 🔄 Backup & Recovery

### Backup Strategy
1. **Daily full backup** of entire database
2. **Hourly incremental backup** of critical tables
3. **Weekly backup verification**
4. **Off-site backup storage**

### Critical Tables (Priority Order)
1. users
2. articles
3. article_comments
4. article_approvals
5. disaster_categories
6. prevention_tips

---

**Database Version:** 1.0  
**Last Updated:** December 23, 2025  
**Maintained by:** SIGAP ALAM Development Team
