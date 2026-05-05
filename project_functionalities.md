# Inntera Project Functionalities

This document details the comprehensive features and functionalities of the Inntera Hotel Booking System, categorized by user roles and system capabilities.

---

## 1. Core System Features

### Authentication & Authorization
- **Multi-Role Support**: Distinct interfaces and permissions for **Admins**, **Staff**, and **Guests**.
- **Secure Authentication**: JWT-based login and registration system.
- **Social Login**: Integrated **Google OAuth** for seamless guest registration and sign-in.
- **Profile Management**: Users can update their personal information, contact details, and security settings.

### Notification System
- **Real-time Alerts**: Automatic notifications for booking confirmations, status updates, and system alerts.
- **Notification Center**: User interface to view, mark as read, or clear notification history.

---

## 2. Guest (Client) Functionalities

### Hotel Discovery
- **Search Engine**: Search for hotels based on location, availability, and preferences.
- **Detailed Listings**: View hotel profiles with descriptions, high-quality images, amenities, and operating hours.
- **Room Selection**: Browse different room types (Deluxe, Suite, etc.) with pricing and occupancy details.

### Reservation Management
- **Direct Booking**: Seamless reservation flow for selecting dates, room types, and guest counts.
- **Booking History**: Access a comprehensive log of past, current, and upcoming reservations.
- **Reference Tracking**: Each booking generates a unique reference code for easy tracking.
- **Cancellation**: Capability to cancel pending or confirmed reservations through the dashboard.

---

## 3. Staff Functionalities

### Front Desk Operations
- **Check-in/Check-out**: Streamlined workflow for managing guest arrivals and departures.
- **Live Booking List**: Real-time view of all active and upcoming bookings for the day.
- **Guest verification**: Access guest details and booking references for on-site verification.

### Room & Inventory Management
- **Status Control**: Update room states in real-time (Available, Occupied, Reserved, Maintenance).
- **Housekeeping/Cleaning**: Dedicated interface for tracking room cleaning status and readiness for new guests.
- **Maintenance Logging**: Ability to flag rooms requiring repairs or maintenance.

---

## 4. Admin Functionalities

### User & Staff Management
- **Guest Administration**: Monitor guest accounts, with capabilities to update profiles or ban users for policy violations.
- **Staff Control**: Hire and manage staff members, assign roles (Manager, Receptionist, etc.), and suspend accounts if necessary.

### Property Management
- **Hotel Inventory**: Full CRUD (Create, Read, Update, Delete) operations for hotel properties.
- **Room Configuration**: Manage room types, individual room numbers, floor assignments, and specific room amenities.
- **Image Management**: Upload and update imagery for hotels and room types to enhance guest appeal.

### Strategic Tools
- **Dynamic Rate Management**: Set and adjust room rates based on seasons (Low, Regular, High, Peak) or specific date ranges.
- **Amenity Catalog**: Manage the global list of amenities available across all properties.

### Analytics & Reporting
- **Business Intelligence**: Dashboard with high-level metrics (Total Revenue, Occupancy Rates, User Growth).
- **Detailed Reports**: Generate insights into booking trends, hotel performance, and staff productivity.

---

## 5. Technical Operations

### Data Integrity
- **Soft Deletes**: Critical data (Users, Hotels, Bookings) is soft-deleted to maintain audit trails and data recovery capabilities.
- **Denormalized Lookups**: Strategically denormalized fields (e.g., `hotel_name` in `rooms`) for optimized read performance.

### Transactional Security
- **Payment Processing**: Integration for multiple payment methods including Credit Cards, GCash, PayPal, and Cash.
- **Transaction Logging**: Detailed recording of all payments, charges, and status changes for financial auditing.
