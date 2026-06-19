# Visitor Management System / Online Visitors Book Build Spec

## Product Goal

Build a secure web-based visitors book for reception teams and administrators to register visitors, track check-ins and check-outs, monitor visitor volume, and report on visitor activity by date, host, and visitor type.

## Primary Users

- Admin user: manages visitor records, dashboard analytics, system settings, and user access.
- Reception user: registers visitors, checks visitors in and out, and searches current or past visits.
- Host user: receives visitor notifications and can confirm expected guests when enabled.

## Core Workflows

1. Dashboard
   - Show total visitors, checked-in visitors, checked-out visitors, and peak visitor count.
   - Filter metrics by date range.
   - Show visitor statistics by week, month, and year.
   - Show visitor type distribution.
   - Show recent visitors and top repeat visitors.

2. Add New Visitor
   - Capture visitor name, phone, email, organization, visitor type, host, visit purpose, check-in date/time, and optional ID/reference number.
   - Mark visitor as checked in after registration.
   - Notify host when notification channels are configured.

3. Visitor List
   - Search and filter visitors by name, host, type, status, and date range.
   - Open a visitor record for details.
   - Check out active visitors.

4. Reports
   - Generate visitor logs by day, week, month, host, department, and visitor type.
   - Export report data to CSV or PDF.

5. Notifications
   - Show host notification status and failed alerts.
   - Support notification preferences for email or SMS in a later phase.

6. Settings
   - Manage visitor types, hosts/departments, roles, retention settings, and branding.

## Data Model

- users: name, email, password, role, status.
- visitors: full_name, email, phone, organization, visitor_type_id, id_number, notes.
- visits: visitor_id, host_user_id, purpose, status, checked_in_at, checked_out_at, expected_at.
- visitor_types: name, color, active.
- notifications: visit_id, channel, recipient, status, sent_at, failure_reason.

## UI Specification

- The dashboard uses a dark teal navigation rail, grey page background, white cards, and cyan/blue action accents.
- Metric cards must remain scannable at desktop and tablet widths, with mobile stacking.
- The recent visitors table must support horizontal scrolling on small screens instead of clipping.
- Chart blocks can use static visual placeholders initially, then be wired to real analytics endpoints.
- Cards use an 8px radius to stay close to the supplied reference.

## Implementation Phases

1. Static UI dashboard and navigation structure.
2. Visitor, visit, and visitor type database migrations and models.
3. Registration and check-in/check-out forms.
4. Dashboard metrics and visitor listing backed by real data.
5. Reports, exports, notifications, and access control polish.

## Acceptance Criteria

- Dashboard matches the supplied visual direction.
- Dashboard remains usable at mobile, tablet, and desktop widths.
- Authenticated users can access the dashboard route.
- Future backend work can replace static dashboard arrays without redesigning the view.
