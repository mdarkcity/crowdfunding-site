-- users
INSERT INTO `User` VALUES ('theneedledrop', 'Anthony Fantano', 'ra1nb0wk3k', '1357246835794680', 'Plainville', 'The Internet\'s busiest music nerd.');
INSERT INTO `User` VALUES ('JConrad', 'Julia Conrad', 'Redaktorsha92', '3333114209097777', 'New York', 'Well, my pen is a pistola - OOH-OOO');
INSERT INTO `User` VALUES ('Sony_Macaroni', 'Harry Bryan', 'chap1man2', NULL, 'NYC', 'Actor / Writer / Producer / Clown ...');
INSERT INTO `User` VALUES ('aberubin', 'Alex Rubin', 'f4rtg0TH', '9017892678356745', 'Baltimore', 'Budding filmmaker and horror-pop enthusiast. Watch for dry humor.');
INSERT INTO `User` VALUES ('beccachair', 'Rebecca Moloney', 'trustyrBB101', NULL, 'Tuckahoe', 'Singer @ Old table, sister, friend.');
INSERT INTO `User` VALUES ('BobInBrooklyn', 'Bob Nash', 'lin012256', '1029384756748392', 'Brooklyn', 'nostalgic scrapbooker from Brooklyn new york');
INSERT INTO `User` VALUES ('mikros_oft', 'Amir Nekrasov', 'chortVmne7', '4019666101982131', 'Venezia', 'Thus the man who is responsive to artistic stimuli reacts to the reality of dreams as does the philosopher to the reality of existence; he observes closely, and he enjoys his observation: for it is out of these images that he interprets life, out of these processes that he trains himself for life.\n\n-Friedrich Nietzsche, The Birth of Tragedy from the Spirit of Music');
INSERT INTO `User` VALUES ('lrkrmass', 'Lorne Emitto', 'chc4Now', '1041040100441110', 'Boston', 'Just a lurker. I am partial to jazz. ;0');

-- user followed by other user
INSERT INTO `Follow` VALUES ('theneedledrop', 'lrkrmass');
INSERT INTO `Follow` VALUES ('beccachair', 'lrkrmass');
INSERT INTO `Follow` VALUES ('lrkrmass', 'BobInBrooklyn');
INSERT INTO `Follow` VALUES ('JConrad', 'BobInBrooklyn');
INSERT INTO `Follow` VALUES ('aberubin', 'BobInBrooklyn');
INSERT INTO `Follow` VALUES ('Sony_Macaroni', 'BobInBrooklyn');
INSERT INTO `Follow` VALUES ('beccachair', 'aberubin');
INSERT INTO `Follow` VALUES ('aberubin', 'Sony_Macaroni');
INSERT INTO `Follow` VALUES ('mikros_oft', 'JConrad');

-- projects
INSERT INTO `Project` VALUES (DEFAULT, 'beccachair', '2011-02-11 13:11:55', 'COLORING (book)', 'Greetings! We are Old table, from Tuckahoe, New York. We have been making music for six years, but have never set foot into a studio. That\'s part of our *charm*, you could say.\n\n\nIn preparation for our next home-brewed record, titled COLORING, we have decided to reach out to the community for some financial assistance. Your generosity will go toward furnishing a small \"walk-in-but-can\'t-walk-out\" closet / vocal chamber in our basement, and cables. Mostly cables. Thank you!', 100.00, 500.00, 120.00, '2011-03-20', '2011-05-01', 'late', '2011-05-05');
INSERT INTO `Project` VALUES (DEFAULT, 'beccachair', '2012-04-20 15:32:00', 'Old table / Jesse Carsten SPLIT', 'Calling all fangirls, girlfans, fanmans, and band liaisons: Will is taking a flying boat to Portland next week in order to record a split with our dear friend and frequent collaborator, Jesse Carsten, who has recently destroyed his 4-track in a flight of emotion and stairs. Hm. Please help him replace it!', 120.00, 200.00, 150.00, '2012-04-25', '2012-06-25', 'completed', '2012-06-25');
INSERT INTO `Project` VALUES (DEFAULT, 'beccachair', '2015-07-07 12:51:51', 'Old table\'s SAVE THE ENVIRONMENT', 'Hello all! We are preparing to record our newest record, titled \"SAVE THE ENVIRONMENT\", to be released before the end of the year. We need your help to cover some of the studio fees. Thanks for all your support!', 270.00, 270.00, 270.00, '2015-09-25', '2015-12-31', 'completed', '2015-12-12');
INSERT INTO `Project` VALUES (DEFAULT, 'beccachair', '2017-01-14 01:30:00', 'Old table Collector\'s Box Set!', 'Old table fanatics rejoice! A timeless collection of vinyl, from the Animal Trilogy to our 2015 release, SAVE THE ENVIRONMENT. Please help us PRESS this dream into reality! And keep on rockin in the tri-state.', 350.00, 500.00, 500.00, '2017-04-01', '2017-07-01', 'working', DEFAULT);
INSERT INTO `Project` VALUES (DEFAULT, 'Sony_Macaroni', '2017-02-20 19:45:02', 'The Morning Host Show Web Series!!!', 'THE MORNING HOST SHOW is about a Morning Host NAMED Morning Host and She HATES It! Watch her fight off celebrities and evil in this action-packed comedy! Savor the lunacy! But, we need your help.\n\nAfter debuting our first five live episodes at Reckless Theater, we\'ve decided to move into the web-o-sphere and begin filming the show. We hope to collect at least $1500 in order to cover camera rentals, a set, and Stone Cold Steve Austin\'s modest salary. (Just kidding about that last one. Maybe.) Thank you, lovely minions!', 1500.00, 3000.00, 460.00, '2017-06-11', '2017-09-01', DEFAULT, DEFAULT);
INSERT INTO `Project` VALUES (DEFAULT, 'mikros_oft', '2017-02-26 06:05:07', 'Nihil Clock', 'I am writing a novel. It is about life. Please give me money.', 12.00, 1000000.00, 5.00, '2017-03-26', '2018-03-30', 'unsuccessful', DEFAULT);
INSERT INTO `Project` VALUES (DEFAULT, 'aberubin', DEFAULT, 'Easter in America - a Movie', 'Estranged buddies — withdrawn Aidan and pseudo-thug Leshawn - bullshit their way through an awkward reunion until a shared tragedy & repressed emotions test a bond thought lost.', 300.00, 500.00, DEFAULT, '2017-06-01', '2017-08-01', DEFAULT, DEFAULT);

-- tags
INSERT INTO `ProjectTag` VALUES (1, 'anarcho soft-rock');
INSERT INTO `ProjectTag` VALUES (1, 'experimental');
INSERT INTO `ProjectTag` VALUES (1, 'jazz');
INSERT INTO `ProjectTag` VALUES (1, 'basement recording');
INSERT INTO `ProjectTag` VALUES (2, 'old table');
INSERT INTO `ProjectTag` VALUES (2, 'jesse cartsen');
INSERT INTO `ProjectTag` VALUES (2, 'folk-punk');
INSERT INTO `ProjectTag` VALUES (2, '4-track');
INSERT INTO `ProjectTag` VALUES (3, 'anarcho soft-rock');
INSERT INTO `ProjectTag` VALUES (3, 'old table');
INSERT INTO `ProjectTag` VALUES (3, 'save the environment');
INSERT INTO `ProjectTag` VALUES (3, 'green party');
INSERT INTO `ProjectTag` VALUES (4, 'old table');
INSERT INTO `ProjectTag` VALUES (4, 'box set');
INSERT INTO `ProjectTag` VALUES (4, 'rock music');
INSERT INTO `ProjectTag` VALUES (4, 'jazz');
INSERT INTO `ProjectTag` VALUES (4, 'saxomaphone');
INSERT INTO `ProjectTag` VALUES (5, 'morning host');
INSERT INTO `ProjectTag` VALUES (5, 'webisodes');
INSERT INTO `ProjectTag` VALUES (5, 'comedy');
INSERT INTO `ProjectTag` VALUES (6, 'nothing');
INSERT INTO `ProjectTag` VALUES (7, 'student film');
INSERT INTO `ProjectTag` VALUES (7, 'film');
INSERT INTO `ProjectTag` VALUES (7, 'wholesome');
INSERT INTO `ProjectTag` VALUES (7, 'all-nighter');

-- material
INSERT INTO `Material` VALUES (2, 'Jesse\'s old thang looked a bit like this:', '4track.jpg', 'image', '2012-04-21 12:04:20');

-- likes
INSERT INTO `Like` VALUES ('lrkrmass', 1, '2011-02-20 21:21:39');
INSERT INTO `Like` VALUES ('aberubin', 1, '2011-03-10 20:02:00');
INSERT INTO `Like` VALUES ('lrkrmass', 2, '2012-04-24 09:50:00');
INSERT INTO `Like` VALUES ('aberubin', 3, '2015-07-08 01:02:22');
INSERT INTO `Like` VALUES ('BobInBrooklyn', 3, '2015-08-01 00:31:01');
INSERT INTO `Like` VALUES ('aberubin', 4, '2017-01-15 01:12:22');
INSERT INTO `Like` VALUES ('beccachair', 4, '2017-01-15 02:32:10');
INSERT INTO `Like` VALUES ('lrkrmass', 4, '2017-01-20 10:10:10');
INSERT INTO `Like` VALUES ('theneedledrop', 4, '2017-02-10 11:00:32');
INSERT INTO `Like` VALUES ('Sony_Macaroni', 5, '2017-02-20 20:05:22');
INSERT INTO `Like` VALUES ('BobInBrooklyn', 5, '2017-03-01 15:03:10');
INSERT INTO `Like` VALUES ('JConrad', 7, '2017-04-21 21:29:46');
INSERT INTO `Like` VALUES ('Sony_Macaroni', 7, '2017-04-21 22:22:22');

-- comments
INSERT INTO `Comment` VALUES ('lrkrmass', 1, 'awesome! i saw you guys at some house show in the bronx one time. keep it uuuuuupp', '2011-02-20 21:11:00', DEFAULT);
INSERT INTO `Comment` VALUES ('lrkrmass', 3, 'Woooooo I have no money :(', '2015-07-09 14:12:22', DEFAULT);
INSERT INTO `Comment` VALUES ('theneedledrop', 3, 'Go forth and prosper.', '2015-09-21 11:00:00', DEFAULT);
INSERT INTO `Comment` VALUES ('JConrad', 6, 'What.', '2017-03-05 10:00:00', DEFAULT);
INSERT INTO `Comment` VALUES ('JConrad', 5, 'Yes to the yes. Giving the people what they want, at last.', '2017-04-11 09:01:22', DEFAULT);
INSERT INTO `Comment` VALUES ('Sony_Macaroni', 7, 'Oooh, this looks goood', DEFAULT, DEFAULT);

-- pledges
INSERT INTO `Pledge` VALUES ('lrkrmass', 1, 100.00, '2011-02-20 21:21:21', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('aberubin', 1, 20.00, '2011-03-10 20:10:00', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('lrkrmass', 2, 150.00, '2012-04-24 10:00:00', '2012-04-25 12:00:00', 'TRUE');
INSERT INTO `Pledge` VALUES ('aberubin', 3, 45.00, '2015-07-08 02:12:22', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('BobInBrooklyn', 3, 25.00, '2015-08-01 01:01:01', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('theneedledrop', 3, 200.00, '2015-09-21 14:00:05', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('aberubin', 4, 75.00, '2017-01-15 02:12:22', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('lrkrmass', 4, 150.00, '2017-01-29 10:10:10', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('theneedledrop', 4, 200.00, '2017-02-15 09:00:02', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('BobInBrooklyn', 5, 400.00, '2017-03-01 15:23:10', '2017-03-10 15:00:00', 'FALSE');
INSERT INTO `Pledge` VALUES ('JConrad', 6, 5.00, '2017-03-05 10:10:00', DEFAULT, 'FALSE');
INSERT INTO `Pledge` VALUES ('mikros_oft', 4, 5.00, '2017-03-11 00:00:00', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('JConrad', 4, 70.00, '2017-03-22 08:10:00', DEFAULT, 'TRUE');
INSERT INTO `Pledge` VALUES ('JConrad', 5, 60.00, '2017-04-11 09:23:10', DEFAULT, 'FALSE');

-- ratings
INSERT INTO `Rate` VALUES ('lrkrmass', 1, 4, '2011-05-06 18:04:11', DEFAULT);
INSERT INTO `Rate` VALUES ('aberubin', 1, 5, '2011-05-10 10:00:11', DEFAULT);
INSERT INTO `Rate` VALUES ('lrkrmass', 2, 4, '2012-06-26 12:07:00', DEFAULT);
INSERT INTO `Rate` VALUES ('BobInBrooklyn', 3, 3, '2015-12-13 10:09:00', DEFAULT);
INSERT INTO `Rate` VALUES ('theneedledrop', 3, 5, '2015-12-16 19:29:30', DEFAULT);
INSERT INTO `Rate` VALUES ('aberubin', 3, 5, '2015-12-17 14:09:00', DEFAULT);
