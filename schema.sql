-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2009 at 03:46 PM
-- Server version: 4.1.25
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `schul030_butcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `uid` varchar(4) NOT NULL default '',
  `time` varchar(12) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE IF NOT EXISTS `approved` (
  `posterid` varchar(5) NOT NULL default '',
  `posterip` varchar(16) NOT NULL default '',
  `approverid` varchar(5) NOT NULL default '',
  `id` varchar(6) NOT NULL default '',
  `content` text NOT NULL,
  `time` varchar(12) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `time` varchar(12) NOT NULL default '',
  `id` varchar(4) NOT NULL default '',
  `content` text NOT NULL,
  `uid` varchar(15) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `mods`
--

CREATE TABLE IF NOT EXISTS `mods` (
  `uid` varchar(6) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `message` text NOT NULL,
  `id` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `totalsubmitted`
--

CREATE TABLE IF NOT EXISTS `totalsubmitted` (
  `amount` varchar(10) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` varchar(4) NOT NULL default '',
  `uname_low` varchar(20) NOT NULL default '',
  `uname` varchar(20) NOT NULL default '',
  `fname` varchar(15) NOT NULL default '',
  `lname` varchar(15) NOT NULL default '',
  `hash` varchar(40) NOT NULL default '',
  `bday` char(2) NOT NULL default '',
  `bmonth` char(2) NOT NULL default '',
  `byear` varchar(4) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `hash_back` varchar(40) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `waiting`
--

CREATE TABLE IF NOT EXISTS `waiting` (
  `posterid` varchar(5) NOT NULL default '',
  `posterip` varchar(16) NOT NULL default '',
  `content` text NOT NULL,
  `time` varchar(12) NOT NULL default '',
  `tempid` varchar(10) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

