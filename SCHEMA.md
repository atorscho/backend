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
- gender:enum(N, M, F)
- created_at
- updated_at

`groups`, `permissions`

- id:increments
- name:string
- handle:string:unique
- prefix:string
- suffix:string

`field_groups`

- id:increments
- name:string
- handle:string:unique

`userfields`                    `field_user`

- id:increments                 - field_id -> userfields(id)
- group_id:integer:unsigned     - user_id -> users(id)
- name:string                   - value:string
- handle:string:unique
- placeholder:string
- required:boolean
- min:string
- max:string
- step:integer:unsigned
- maxlength:integer
- pattern:string

## Settings
`settings_groups`

- id:increments
- name:string
- handle:string:unique

`settings`

- id:increments
- group_id:integer:unsigned
- name:string
- handle:string:unique
- value:string
- default:string
- description:text
