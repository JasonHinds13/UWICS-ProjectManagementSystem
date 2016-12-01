DROP DATABASE IF EXISTS ProjectDB;
CREATE DATABASE ProjectDB;
USE ProjectDB;

-- create table 'leaders' for project leaders

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
    `id` int NOT NULL auto_increment PRIMARY KEY,
    `uwi_id` int NOT NULL default '0',
    `firstname` char(255) NOT NULL default '',
    `lastname` char(255) NOT NULL default '',
    `email` char(255) NOT NULL default '',
    `acctype` char(255) NOT NULL default '',
    `sig` char(255) NOT NULL default '',
    `password` char(255) NOT NULL default ''
);

-- create table 'projects' for projects

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
    `id` int NOT NULL auto_increment PRIMARY KEY,
    `name` char(255) NOT NULL default '',
    `member` char(255) NOT NULL default '',
    `description` char(255) NOT NULL default '',
    `sig` char(255) NOT NULL default ''
);

-- create table 'tasks' for project tasks

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
    `id` int NOT NULL auto_increment PRIMARY KEY,
    `project_id` int NOT NULL default '0',
    `name` char(255) NOT NULL default '',
    `description` char(255) NOT NULL default '',
    `member` char(255) NOT NULL default '',
    `progress` char(255) NOT NULL default ''
);

-- create table 'interestgroup'

DROP TABLE IF EXISTS `interestgroup`;
CREATE TABLE `interestgroup` (
    `id` int NOT NULL auto_increment PRIMARY KEY,
    `leader_id` int NOT NULL default '0',
    `name` char(255) NOT NULL default ''
);