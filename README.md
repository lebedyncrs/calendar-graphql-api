# Installation guide
1. Clone repository via:
  SSH ```git@github.com:lebedyncrs/calendar-graphql-api.git```
  HTTPS ```https://github.com/lebedyncrs/calendar-graphql-api.git```
2. Run ```build.sh``` script in your terminal
3. Open ```http://localhost/graphql-ui?query=query%20getTimezones%20%7B%0A%20%20timezones%20%7B%0A%20%20%20%20name%0A%20%20%7D%0A%7D%0A%0Aquery%20getAccessLevels%20%7B%0A%20%20accessLevels%20%7B%0A%20%20%20%20data%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20key%0A%20%20%20%20%20%20description%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Amutation%20logIn%20%7B%0A%20%20login(email%3A%20%22john.smith%40gmail.com%22%2C%20password%3A%20%22default-pass%22)%20%7B%0A%20%20%20%20token%0A%20%20%20%20user%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20surname%0A%20%20%20%20%20%20email%0A%20%20%20%20%20%20timezone%0A%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20updated_at%0A%20%20%20%20%20%20calendar%20%7B%0A%20%20%20%20%20%20%20%20id%0A%20%20%20%20%20%20%20%20name%0A%20%20%20%20%20%20%20%20color%0A%20%20%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20%20%20updated_at%0A%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Aquery%20getUsers%20%7B%0A%20%20users%20%7B%0A%20%20%20%20data%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20surname%0A%20%20%20%20%20%20email%0A%20%20%20%20%20%20timezone%0A%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20updated_at%0A%20%20%20%20%20%20calendar%20%7B%0A%20%20%20%20%20%20%20%20id%0A%20%20%20%20%20%20%20%20name%0A%20%20%20%20%20%20%20%20color%0A%20%20%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20%20%20updated_at%0A%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%20%20%20%20total%0A%20%20%7D%0A%7D%0A%0Aquery%20getUser%20%7B%0A%20%20user(id%3A%201)%20%7B%0A%20%20%20%20id%0A%20%20%20%20name%0A%20%20%20%20surname%0A%20%20%20%20email%0A%20%20%20%20timezone%0A%20%20%20%20created_at%0A%20%20%20%20updated_at%0A%20%20%20%20calendar%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20color%0A%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20updated_at%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Amutation%20updateUser%20%7B%0A%20%20updateUser(id%3A%202%2C%20name%3A%20%22NewName%22)%20%7B%0A%20%20%20%20id%0A%20%20%20%20name%0A%20%20%20%20surname%0A%20%20%20%20email%0A%20%20%20%20timezone%0A%20%20%20%20created_at%0A%20%20%20%20updated_at%0A%20%20%20%20calendar%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20color%0A%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20updated_at%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Amutation%20deleteUser%20%7B%0A%20%20deleteUser(id%3A%201)%20%7B%0A%20%20%20%20deleted%0A%20%20%7D%0A%7D%0A%0Aquery%20getCalendar%20%7B%0A%20%20calendar%20%7B%0A%20%20%20%20id%0A%20%20%20%20name%0A%20%20%20%20color%0A%20%20%20%20owner_id%0A%20%20%20%20created_at%0A%20%20%20%20updated_at%0A%20%20%20%20owner%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20surname%0A%20%20%20%20%7D%0A%20%20%20%20events%20%7B%0A%20%20%20%20%20%20title%0A%20%20%20%20%20%20description%0A%20%20%20%20%20%20start_at%0A%20%20%20%20%20%20end_at%0A%20%20%20%20%20%20is_all_day%0A%20%20%20%20%20%20timezone%0A%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20parent_id%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Aquery%20getSharedCalendars%20%7B%0A%20%20sharedCalendars%20%7B%0A%20%20%20%20data%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20color%0A%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20created_at%0A%20%20%20%20%20%20updated_at%0A%20%20%20%20%20%20events%20%7B%0A%20%20%20%20%20%20%20%20title%0A%20%20%20%20%20%20%20%20description%0A%20%20%20%20%20%20%20%20start_at%0A%20%20%20%20%20%20%20%20end_at%0A%20%20%20%20%20%20%20%20is_all_day%0A%20%20%20%20%20%20%20%20timezone%0A%20%20%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20%20%20parent_id%0A%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Amutation%20shareCalendar%20%7B%0A%20%20newCalendarShare(users_id%3A4%2C%20access_levels_id%3A%201)%20%7B%0A%20%20%20%20id%0A%20%20%20%20calendars_id%0A%20%20%20%20users_id%0A%20%20%20%20access_levels_id%0A%20%20%20%20user%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%7D%0A%20%20%20%20calendar%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%7D%0A%0A%20%20%7D%0A%7D%0A%0Amutation%20updateCalendarSharing%20%7B%0A%20%20newCalendarShare(users_id%3A4%2C%20access_levels_id%3A%201)%20%7B%0A%20%20%20%20id%0A%20%20%20%20calendars_id%0A%20%20%20%20users_id%0A%20%20%20%20access_levels_id%0A%20%20%20%20user%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%7D%0A%20%20%20%20calendar%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20name%0A%20%20%20%20%7D%0A%0A%20%20%7D%0A%7D%0A%0Aquery%20getEvents%20%7B%0A%20%20events%20%7B%0A%20%20%20%20data%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20title%0A%20%20%20%20%20%20description%0A%20%20%20%20%20%20start_at%0A%20%20%20%20%20%20end_at%0A%20%20%20%20%20%20is_all_day%0A%20%20%20%20%20%20timezone%0A%20%20%20%20%20%20owner_id%0A%20%20%20%20%20%20parent_id%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D%0A%0Amutation%20createEvent%20%7B%0A%20%20newEvent(title%3A%20%22Start%20New%20Day%22%2C%20timezone%3A%20%22america%22)%20%7B%0A%20%20%20%20id%0A%20%20%20%20title%0A%20%20%7D%0A%7D%0A%0Amutation%20updateEvent%20%7B%0A%20%20updateEvent(id%3A%201%2C%20timezone%3A%20%22123123america%22)%20%7B%0A%20%20%20%20id%0A%20%20%20%20title%0A%20%20%20%20timezone%0A%20%20%7D%0A%7D%0A%0Amutation%20deleteEvent%20%7B%0A%20%20deleteEvent(id%3A%201)%20%7B%0A%20%20%20%20deleted%0A%20%20%7D%0A%7D%0A%0Amutation%20newEventGuestInvitation%20%7B%0A%20%20newEventGuest(events_id%3A%201%2C%20users_id%3A%201%2C%20access_levels_id%3A%201%2C%20invitation_statuses_id%3A%201)%20%7B%0A%20%20%20%20id%0A%20%20%20%20events_id%0A%20%20%20%20users_id%0A%20%20%20%20access_levels_id%0A%20%20%20%20invitation_statuses_id%0A%20%20%7D%0A%7D%0A%0Amutation%20updateEventGuestInvitation%20%7B%0A%20%20updateEventGuest(id%3A%2052%2C%20events_id%3A%2010%2C%20users_id%3A%201%2C%20access_levels_id%3A%201%2C%20invitation_statuses_id%3A%201)%20%7B%0A%20%20%20%20id%0A%20%20%20%20events_id%0A%20%20%20%20users_id%0A%20%20%20%20access_levels_id%0A%20%20%20%20invitation_statuses_id%0A%20%20%7D%0A%7D%0A%0Amutation%20deleteEventGuestInvitation%20%7B%0A%20%20deleteEventGuest(id%3A%2052)%20%7B%0A%20%20%20%20deleted%0A%20%20%7D%0A%7D%0A%0A%0A%0A%0A%0A&operationName=getTimezones``` in your browser


# Design And Concepts
