# Database
List of components:

- [x] Users
- [x] User Fields (User fields)
- [x] Groups
- [x] Permissions
- [x] Configurations
- [ ] Menus **to be reviewed**
- [ ] Categories
- [ ] Articles
- [ ] Pages
- [ ] Forums & Categories
- [ ] Topics & Posts

## Users & Groups
`users`

- id:increments
- username:string:unique
- email:string:unique
- password:string(60)
- remember_token
- avatar:string:nullable
- first_name:string:nullable
- last_name:string:nullable
- gender:enum(none, male, female)
- created_at
- updated_at

`usermeta`

- id:increments
- user_id:integer:unsigned
- name:string
- handle:string:unique
- value:string
- created_at
- updated_at

`groups`, `permissions`

- id:increments
- name:string
- handle:string:unique

## Options (Settings)
`options`

- id:increments
- name:string
- handle:string:unique
- value:string:nullable
- default:string:nullable
- description:text:nullable

`optgroups`

- id:increments
- name:string
- handle:string:unique
