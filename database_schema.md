# Inntera Database Schema

This document outlines the database structure for the Inntera Hotel Booking System.

## Tables

### 1. `users`
Stores primary authentication and profile data for all users (Admins, Staff, and Guests).

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (Primary Key) | No | Unique identifier for the user. |
| `name` | varchar(255) | No | Full name of the user. |
| `email` | varchar(255) | No | Unique email address. |
| `email_verified_at` | timestamp | Yes | Date and time when the email was verified. |
| `password` | varchar(255) | No | Hashed password. |
| `role` | enum('admin', 'staff', 'guest') | No | Access level (default: 'guest'). |
| `phone` | varchar(255) | Yes | Contact phone number. |
| `address` | varchar(255) | Yes | Physical address. |
| `city` | varchar(255) | Yes | City of residence. |
| `country` | varchar(255) | Yes | Country of residence. |
| `remember_token` | varchar(100) | Yes | Token for "remember me" functionality. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 2. `guests`
Stores specific profile information for guests, including Google Auth details and loyalty data.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (Primary Key) | No | Unique identifier for the guest. |
| `google_id` | varchar(255) | Yes | Unique Google identifier for OAuth. |
| `display_id` | varchar(255) | No | Human-readable unique identifier. |
| `first_name` | varchar(255) | No | Guest's first name. |
| `middle_name` | varchar(255) | Yes | Guest's middle name. |
| `last_name` | varchar(255) | No | Guest's last name. |
| `email` | varchar(255) | No | Unique guest email. |
| `avatar` | varchar(255) | Yes | URL to the guest's profile picture. |
| `password` | varchar(255) | Yes | Hashed password (nullable for social logins). |
| `phone` | varchar(255) | Yes | Contact number. |
| `address` | varchar(255) | Yes | Street address. |
| `city` | varchar(255) | Yes | City. |
| `country` | varchar(255) | Yes | Country. |
| `loyalty_member_id` | varchar(255) | Yes | Loyalty program identifier. |
| `status` | enum('active', 'banned') | No | Account status (default: 'active'). |
| `created_at` | timestamp | No | Registration timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 3. `hotels`
Stores hotel property information and metadata.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (Primary Key) | No | Unique identifier for the hotel. |
| `display_id` | varchar(255) | No | Human-readable unique identifier. |
| `name` | varchar(255) | No | Hotel name. |
| `description` | text | Yes | Detailed description of the hotel. |
| `address` | varchar(255) | No | Street address. |
| `city` | varchar(255) | No | City. |
| `state` | varchar(255) | Yes | State/Province. |
| `country` | varchar(255) | No | Country. |
| `postal_code` | varchar(255) | Yes | Postal/Zip code. |
| `latitude` | decimal(10,8) | Yes | Geographical latitude. |
| `longitude` | decimal(11,8) | Yes | Geographical longitude. |
| `phone` | varchar(255) | No | Contact phone number. |
| `opens_at` | varchar(255) | Yes | Opening hours start. |
| `closes_at` | varchar(255) | Yes | Opening hours end. |
| `email` | varchar(255) | No | Contact email address. |
| `total_rooms` | integer | No | Total room capacity (default: 0). |
| `available_rooms` | integer | No | Current available rooms (default: 0). |
| `star_rating` | integer | Yes | Hotel rating (1-5). |
| `image_url` | text | Yes | Primary image URL. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 4. `staff`
Stores information about hotel employees.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (Primary Key) | No | Unique identifier for the staff member. |
| `display_id` | varchar(255) | No | Human-readable unique identifier. |
| `user_id` | bigint (FK) | No | Reference to `users.id`. |
| `hotel_id` | bigint (FK) | No | Reference to `hotels.id`. |
| `position` | enum('manager', 'receptionist', 'housekeeping', 'maintenance') | No | Job role. |
| `status` | enum('active', 'suspended') | No | Employment status (default: 'active'). |
| `hire_date` | timestamp | No | Date of hiring. |
| `created_at` | timestamp | No | Record creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 5. `room_types`
Defines categories of rooms and their characteristics.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `room_type_id` | bigint (Primary Key) | No | Unique identifier for the room type. |
| `hotel_id` | bigint (FK) | No | Reference to `hotels.id`. |
| `name` | varchar(255) | No | Room type name (e.g., Deluxe, Suite). |
| `description` | text | Yes | Description of the room type. |
| `base_price` | decimal(10,2) | No | Standard nightly rate. |
| `max_occupancy` | integer | No | Maximum number of guests allowed. |
| `status` | enum('active', 'inactive') | No | Status of the room type (default: 'active'). |
| `bed_type` | enum('Single', 'Double') | No | Type of bed provided. |
| `image_url` | varchar(255) | Yes | URL for room type preview image. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 6. `rooms`
Individual room units within a hotel.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `room_id` | bigint (Primary Key) | No | Unique identifier for the room. |
| `hotel_id` | bigint (FK) | No | Reference to `hotels.id`. |
| `hotel_name` | varchar(255) | No | Denormalized hotel name for easier lookup. |
| `room_type_id` | bigint (FK) | No | Reference to `room_types.room_type_id`. |
| `room_number` | varchar(255) | No | Room designation number/string. |
| `floor` | enum('Ground', '1st' to '10th') | No | Floor level. |
| `status` | enum('available', 'occupied', 'maintenance', 'reserved', 'cleaning') | No | Current room status. |
| `notes` | text | Yes | Internal maintenance or status notes. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 7. `bookings`
Reservation records for guests.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `booking_id` | bigint (Primary Key) | No | Unique identifier for the booking. |
| `booking_reference` | varchar(255) | No | Unique confirmation code. |
| `guest_id` | bigint (FK) | No | Reference to `guests.id`. |
| `guest_name` | varchar(255) | Yes | Denormalized guest name. |
| `hotel_id` | bigint (FK) | No | Reference to `hotels.id`. |
| `checkin_date` | date | No | Scheduled check-in date. |
| `checkout_date` | date | No | Scheduled check-out date. |
| `booking_status` | enum('pending', 'confirmed', 'checked-in', 'checked-out', 'cancelled') | No | Reservation status. |
| `total_cost` | decimal(10,2) | No | Total amount for the reservation. |
| `notes` | text | Yes | Special requests or booking notes. |
| `created_at` | timestamp | No | Booking creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 8. `payments`
Financial transactions associated with bookings.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `payment_id` | bigint (Primary Key) | No | Unique identifier for the payment. |
| `booking_id` | bigint (FK) | No | Reference to `bookings.booking_id`. |
| `amount` | decimal(10,2) | No | Transaction amount. |
| `payment_method` | enum('credit_card', 'debit_card', 'bank_transfer', 'gcash', 'paypal', 'paymaya', 'cash') | No | Payment method used. |
| `status` | enum('pending', 'completed', 'failed', 'refunded') | No | Payment status. |
| `transaction_id` | varchar(255) | Yes | Gateway transaction identifier. |
| `payment_date` | timestamp | Yes | Date/time of payment completion. |
| `notes` | text | Yes | Payment-related notes. |
| `created_at` | timestamp | No | Record creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 9. `amenities`
Catalog of available amenities (e.g., WiFi, Pool).

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `amenity_id` | bigint (Primary Key) | No | Unique identifier for the amenity. |
| `name` | varchar(255) | No | Name of the amenity. |
| `description` | text | Yes | Description of the amenity. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 10. `room_amenities`
Pivot table linking `room_types` to `amenities`.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (Primary Key) | No | Unique identifier. |
| `room_type_id` | bigint (FK) | No | Reference to `room_types.room_type_id`. |
| `amenity_id` | bigint (FK) | No | Reference to `amenities.amenity_id`. |
| `created_at` | timestamp | No | Association timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |

---

### 11. `rates`
Seasonal or dynamic pricing rules.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `rate_id` | bigint (Primary Key) | No | Unique identifier for the rate rule. |
| `room_type_id` | bigint (FK) | No | Reference to `room_types.room_type_id`. |
| `price` | decimal(10,2) | No | Adjusted nightly price. |
| `start_date` | date | No | Rule start date. |
| `end_date` | date | No | Rule end date. |
| `season` | enum('low', 'regular', 'high', 'peak') | No | Season category. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 12. `booking_rooms`
Details of specific rooms reserved within a single booking.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (Primary Key) | No | Unique identifier. |
| `booking_id` | bigint (FK) | No | Reference to `bookings.booking_id`. |
| `room_id` | bigint (FK) | No | Reference to `rooms.room_id`. |
| `adults_count` | integer | No | Number of adults in this room. |
| `children_count` | integer | No | Number of children in this room. |
| `rate` | decimal(10,2) | No | Applied rate at the time of booking. |
| `number_of_nights` | integer | No | Duration of stay. |
| `created_at` | timestamp | No | Record creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |

---

### 13. `charges`
Additional costs (e.g., room service, late fees) added to a booking.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `charge_id` | bigint (Primary Key) | No | Unique identifier. |
| `booking_id` | bigint (FK) | No | Reference to `bookings.booking_id`. |
| `charge_type` | varchar(255) | No | Category of charge. |
| `amount` | decimal(10,2) | No | Charge amount. |
| `description` | text | Yes | Details of the charge. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |
| `deleted_at` | timestamp | Yes | Soft delete timestamp. |

---

### 14. `notifications`
System-wide notification records.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | uuid (Primary Key) | No | Unique UUID. |
| `type` | varchar(255) | No | Notification class/type. |
| `notifiable_type` | varchar(255) | No | Polymorphic model type. |
| `notifiable_id` | bigint | No | Polymorphic model ID. |
| `data` | text | No | JSON payload of notification content. |
| `read_at` | timestamp | Yes | When the notification was read. |
| `created_at` | timestamp | No | Creation timestamp. |
| `updated_at` | timestamp | No | Last update timestamp. |

---

### 15. `sessions`
Tracking active user web sessions.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | varchar(255) (Primary Key) | No | Unique session ID. |
| `user_id` | bigint | Yes | Associated user ID. |
| `ip_address` | varchar(45) | Yes | Client IP. |
| `user_agent` | text | Yes | Browser user agent. |
| `payload` | longtext | No | Serialized session data. |
| `last_activity` | integer | No | Timestamp of last activity. |

---

### 16. `password_reset_tokens`
Stores tokens for secure password resets.

| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `email` | varchar(255) (Primary Key) | No | Email address. |
| `token` | varchar(255) | No | Hashed reset token. |
| `created_at` | timestamp | Yes | Creation timestamp. |

---

## Infrastructure Tables

### 17. `cache` & `cache_locks`
Used by Laravel for application caching and atomic locking.

**`cache`**
| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `key` | varchar(255) (PK) | No | Cache key. |
| `value` | mediumtext | No | Cached value. |
| `expiration` | integer | No | Expiration timestamp. |

**`cache_locks`**
| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `key` | varchar(255) (PK) | No | Lock key. |
| `owner` | varchar(255) | No | Lock owner identifier. |
| `expiration` | integer | No | Expiration timestamp. |

---

### 18. `jobs`, `job_batches`, & `failed_jobs`
Used for background task processing and queue management.

**`jobs`**
| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (PK) | No | Job identifier. |
| `queue` | varchar(255) | No | Queue name. |
| `payload` | longtext | No | Job payload data. |
| `attempts` | tinyint | No | Number of attempts. |
| `reserved_at` | integer | Yes | Timestamp when job was reserved. |
| `available_at` | integer | No | Timestamp when job becomes available. |
| `created_at` | integer | No | Creation timestamp. |

**`job_batches`**
| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | varchar(255) (PK) | No | Batch identifier. |
| `name` | varchar(255) | No | Batch name. |
| `total_jobs` | integer | No | Total jobs in batch. |
| `pending_jobs` | integer | No | Pending jobs in batch. |
| `failed_jobs` | integer | No | Failed jobs in batch. |
| `failed_job_ids` | longtext | No | IDs of failed jobs. |
| `options` | mediumtext | Yes | Batch options. |
| `cancelled_at` | integer | Yes | Cancellation timestamp. |
| `created_at` | integer | No | Creation timestamp. |
| `finished_at` | integer | Yes | Completion timestamp. |

**`failed_jobs`**
| Column | Type | Nullable | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint (PK) | No | Failed job identifier. |
| `uuid` | varchar(255) | No | Unique identifier. |
| `connection` | text | No | Queue connection. |
| `queue` | text | No | Queue name. |
| `payload` | longtext | No | Job payload. |
| `exception` | longtext | No | Exception details. |
| `failed_at` | timestamp | No | Failure timestamp. |
