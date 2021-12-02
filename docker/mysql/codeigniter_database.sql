
create table if not exists chat
(
    id     bigint unsigned auto_increment,
    msg    varchar(250) null,
    pseudo varchar(250) null,
    constraint id
    unique (id)
    );

alter table chat
    add constraint `PRIMARY`
        primary key (id);

create table if not exists users
(
    id     bigint unsigned auto_increment,
    name varchar(100) not null ,
    type varchar(255) not null,
    constraint id
    unique (id)
    )
    comment 'users table' charset = latin1;

alter table users
    add constraint `PRIMARY`
        primary key (id);
