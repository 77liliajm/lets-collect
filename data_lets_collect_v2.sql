-- ============================================================
-- LETS COLLECT — Script de données corrigé
-- Structure réelle de la BDD vérifiée
-- Exécuter avec : mysql -u root -p lets_collect < data_lets_collect_v2.sql
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE photocard_idol;
TRUNCATE TABLE photocard_album_version;
TRUNCATE TABLE album_version;
TRUNCATE TABLE photocard;
TRUNCATE TABLE album;
TRUNCATE TABLE idol;
TRUNCATE TABLE groupe;
TRUNCATE TABLE wishlist;
TRUNCATE TABLE user_collection;
TRUNCATE TABLE utilisateur;
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- GROUPES (nom, agence, date_debut)
-- ============================================================
INSERT INTO groupe (id, nom, agence, date_debut) VALUES
(1, 'Stray Kids', 'JYP Entertainment', '2017-03-25'),
(2, 'BTS',        'HYBE',              '2013-06-13'),
(3, 'Pentagon',   'Cube Entertainment','2016-10-10');

-- ============================================================
-- IDOLS (nom_scene, date_naissance) — PAS de id_groupe ici
-- La relation groupe↔idol passe par les albums/photocards
-- ============================================================
INSERT INTO idol (id, nom_scene, date_naissance) VALUES
(1,  'Bang Chan',  '1997-10-03'),
(2,  'Lee Know',   '1998-10-25'),
(3,  'Changbin',   '1999-08-11'),
(4,  'Hyunjin',    '2000-03-20'),
(5,  'Han',        '2000-09-14'),
(6,  'Felix',      '2000-09-15'),
(7,  'Seungmin',   '2000-09-22'),
(8,  'I.N',        '2001-02-08'),
(9,  'Jimin',      '1995-10-13'),
(10, 'Wooseok',    '1998-12-29');

-- ============================================================
-- ALBUMS (titre, date_sortie, groupe_id)
-- ============================================================
INSERT INTO album (id, titre, date_sortie, groupe_id) VALUES
(1, 'Mixtape',          '2018-01-08', 1),
(2, 'I Am NOT',         '2018-03-26', 1),
(3, 'Karma',            '2025-02-28', 1),
(4, 'Love Yourself Her','2017-09-18', 2),
(5, 'Positive',         '2019-04-29', 3);

-- ============================================================
-- VERSIONS D'ALBUMS (nom_version, album_id)
-- ============================================================
INSERT INTO album_version (id, nom_version, album_id) VALUES
(1, 'Making Version',   1),
(2, 'Selfie Version',   1),
(3, 'Selfie Version',   2),
(4, 'Childhood Version',2),
(5, 'Accordion',        3),
(6, 'O Version',        4),
(7, 'Making Ver',       5);

-- ============================================================
-- PHOTOCARDS (image, raretes, nom_set)
-- Pas de FK directe vers album_version — relation via photocard_album_version
-- ============================================================
INSERT INTO photocard (id, nom_set, image, raretes) VALUES
-- MIXTAPE Making Version
(1,  'Mixtape • Making • Bang Chan',    'photocards/mixtape_making_bangchan.jpg',    'common'),
(2,  'Mixtape • Making • Lee Know',     'photocards/mixtape_making_leeknow.jpg',     'common'),
(3,  'Mixtape • Making • Felix',        'photocards/mixtape_making_felix.jpg',       'common'),
-- MIXTAPE Selfie Version
(4,  'Mixtape • Selfie • Han',          'photocards/mixtape_selfie_han.jpg',         'common'),
(5,  'Mixtape • Selfie • Lee Know',     'photocards/mixtape_selfie_leeknow.jpg',     'common'),
(6,  'Mixtape • Selfie • Seungmin',     'photocards/mixtape_selfie_seungmin.jpg',    'common'),
-- I AM NOT Selfie Version
(7,  'I Am NOT • Selfie • Bang Chan',   'photocards/iamnot_selfie_bangchan.jpg',     'common'),
(8,  'I Am NOT • Selfie • Lee Know',    'photocards/iamnot_selfie_leeknow.jpg',      'common'),
(9,  'I Am NOT • Selfie • Changbin',    'photocards/iamnot_selfie_changbin.jpg',     'common'),
(10, 'I Am NOT • Selfie • Felix',       'photocards/iamnot_selfie_felix.jpg',        'common'),
(11, 'I Am NOT • Selfie • Seungmin',    'photocards/iamnot_selfie_seungmin.jpg',     'common'),
(12, 'I Am NOT • Selfie • I.N',         'photocards/iamnot_selfie_in.jpg',           'common'),
-- I AM NOT Childhood Version
(13, 'I Am NOT • Childhood • Bang Chan','photocards/iamnot_childhood_bangchan.jpg',  'common'),
(14, 'I Am NOT • Childhood • Lee Know', 'photocards/iamnot_childhood_leeknow.jpg',   'common'),
(15, 'I Am NOT • Childhood • Changbin', 'photocards/iamnot_childhood_changbin.jpg',  'common'),
(16, 'I Am NOT • Childhood • Han',      'photocards/iamnot_childhood_han.jpg',       'common'),
(17, 'I Am NOT • Childhood • Felix',    'photocards/iamnot_childhood_felix.jpg',     'common'),
(18, 'I Am NOT • Childhood • I.N',      'photocards/iamnot_childhood_in.jpg',        'common'),
-- KARMA Accordion POB Selfie Version
(19, 'Karma • POB Selfie • Bang Chan',  'photocards/karma_pobselfie_bangchan.jpg',   'rare'),
(20, 'Karma • POB Selfie • Lee Know',   'photocards/karma_pobselfie_leeknow.jpg',    'rare'),
(21, 'Karma • POB Selfie • Lee Know 2', 'photocards/karma_pobselfie_leeknow2.jpg',   'rare'),
(22, 'Karma • POB Selfie • Changbin',   'photocards/karma_pobselfie_changbin.jpg',   'rare'),
(23, 'Karma • POB Selfie • Hyunjin',    'photocards/karma_pobselfie_hyunjin.jpg',    'rare'),
(24, 'Karma • POB Selfie • Han',        'photocards/karma_pobselfie_han.jpg',        'rare'),
(25, 'Karma • POB Selfie • Felix',      'photocards/karma_pobselfie_felix.jpg',      'rare'),
(26, 'Karma • POB Selfie • Seungmin',   'photocards/karma_pobselfie_seungmin.jpg',   'rare'),
(27, 'Karma • POB Selfie • I.N',        'photocards/karma_pobselfie_in.jpg',         'rare'),
(28, 'Karma • POB Selfie • I.N 2',      'photocards/karma_pobselfie_in2.jpg',        'rare'),
(29, 'Karma • POB Selfie • I.N 3',      'photocards/karma_pobselfie_in3.jpg',        'rare'),
-- KARMA Accordion Selfie Version
(30, 'Karma • Selfie • Lee Know',       'photocards/karma_selfie_leeknow.jpg',       'common'),
(31, 'Karma • Selfie • Changbin',       'photocards/karma_selfie_changbin.jpg',      'common'),
(32, 'Karma • Selfie • Hyunjin',        'photocards/karma_selfie_hyunjin.jpg',       'common'),
(33, 'Karma • Selfie • Han',            'photocards/karma_selfie_han.jpg',           'common'),
(34, 'Karma • Selfie • Felix',          'photocards/karma_selfie_felix.jpg',         'common'),
(35, 'Karma • Selfie • Seungmin',       'photocards/karma_selfie_seungmin.jpg',      'common'),
(36, 'Karma • Selfie • I.N',            'photocards/karma_selfie_in.jpg',            'common'),
-- BTS Love Yourself Her
(37, 'LY Her • Making • Jimin',         'photocards/lyher_making_jimin.jpg',         'rare'),
-- Pentagon Positive
(38, 'Positive • Making • Wooseok',     'photocards/positive_making_wooseok.jpg',    'common');

-- ============================================================
-- LIAISON photocard ↔ album_version
-- ============================================================
INSERT INTO photocard_album_version (photocard_id, album_version_id) VALUES
-- Mixtape Making (version id=1)
(1,1),(2,1),(3,1),
-- Mixtape Selfie (version id=2)
(4,2),(5,2),(6,2),
-- I Am NOT Selfie (version id=3)
(7,3),(8,3),(9,3),(10,3),(11,3),(12,3),
-- I Am NOT Childhood (version id=4)
(13,4),(14,4),(15,4),(16,4),(17,4),(18,4),
-- Karma Accordion (version id=5) — POB et Selfie dans la même version Accordion
(19,5),(20,5),(21,5),(22,5),(23,5),(24,5),(25,5),(26,5),(27,5),(28,5),(29,5),
(30,5),(31,5),(32,5),(33,5),(34,5),(35,5),(36,5),
-- Love Yourself Her O Version (version id=6)
(37,6),
-- Positive Making Ver (version id=7)
(38,7);

-- ============================================================
-- LIAISON photocard ↔ idol
-- ============================================================
INSERT INTO photocard_idol (photocard_id, idol_id) VALUES
-- Mixtape Making
(1,1),(2,2),(3,6),
-- Mixtape Selfie
(4,5),(5,2),(6,7),
-- I Am NOT Selfie
(7,1),(8,2),(9,3),(10,6),(11,7),(12,8),
-- I Am NOT Childhood
(13,1),(14,2),(15,3),(16,5),(17,6),(18,8),
-- Karma POB Selfie
(19,1),(20,2),(21,2),(22,3),(23,4),(24,5),(25,6),(26,7),(27,8),(28,8),(29,8),
-- Karma Selfie
(30,2),(31,3),(32,4),(33,5),(34,6),(35,7),(36,8),
-- BTS et Pentagon
(37,9),(38,10);

-- ============================================================
-- UTILISATEURS
-- mot_de_passe = hash bcrypt de "password123"
-- ============================================================
INSERT INTO utilisateur (id, pseudo, email, mot_de_passe, date_inscription, ville) VALUES
(1, 'Lilia', 'lilia@letsco.fr', '$2y$13$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), 'Paris'),
(2, 'Mia',   'mia@letsco.fr',   '$2y$13$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), 'Lyon'),
(3, 'Yuna',  'yuna@letsco.fr',  '$2y$13$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), 'Marseille');

-- ============================================================
-- COLLECTION DE LILIA (id=1) — tes vraies cartes
-- ============================================================
INSERT INTO user_collection (utilisateur_id, photocard_id, etat, quantite, date_ajout) VALUES
-- Mixtape
(1,1,'possede',1,NOW()),(1,2,'possede',1,NOW()),(1,3,'possede',1,NOW()),
(1,4,'possede',1,NOW()),(1,5,'possede',1,NOW()),(1,6,'possede',1,NOW()),
-- I Am NOT
(1,7,'possede',1,NOW()),(1,8,'possede',1,NOW()),(1,9,'possede',1,NOW()),
(1,10,'possede',1,NOW()),(1,11,'possede',1,NOW()),(1,12,'possede',1,NOW()),
(1,13,'possede',1,NOW()),(1,14,'possede',1,NOW()),(1,15,'possede',1,NOW()),
(1,16,'possede',1,NOW()),(1,17,'possede',1,NOW()),(1,18,'possede',1,NOW()),
-- Karma POB (Lee Know x2, I.N x3)
(1,19,'possede',1,NOW()),(1,20,'possede',1,NOW()),
(1,21,'doublon',2,NOW()),  -- Lee Know 2ème exemplaire
(1,22,'possede',1,NOW()),(1,23,'possede',1,NOW()),(1,24,'possede',1,NOW()),
(1,25,'possede',1,NOW()),(1,26,'possede',1,NOW()),(1,27,'possede',1,NOW()),
(1,28,'doublon',2,NOW()),  -- I.N 2ème exemplaire
(1,29,'doublon',3,NOW()),  -- I.N 3ème exemplaire
-- Karma Selfie
(1,30,'possede',1,NOW()),(1,31,'possede',1,NOW()),(1,32,'possede',1,NOW()),
(1,33,'possede',1,NOW()),(1,34,'possede',1,NOW()),(1,35,'possede',1,NOW()),
(1,36,'possede',1,NOW()),
-- BTS et Pentagon
(1,37,'possede',1,NOW()),(1,38,'possede',1,NOW());

-- ============================================================
-- COLLECTION MIA (id=2) — pour simulation d'échange
-- ============================================================
INSERT INTO user_collection (utilisateur_id, photocard_id, etat, quantite, date_ajout) VALUES
(2,1,'doublon',2,NOW()),   -- Bang Chan Mixtape Making (doublon)
(2,19,'doublon',2,NOW()),  -- Karma POB Bang Chan (doublon)
(2,24,'possede',1,NOW()),  -- Karma POB Han
(2,37,'doublon',2,NOW());  -- BTS Jimin (doublon)

-- ============================================================
-- COLLECTION YUNA (id=3) — pour simulation d'échange
-- ============================================================
INSERT INTO user_collection (utilisateur_id, photocard_id, etat, quantite, date_ajout) VALUES
(3,20,'doublon',2,NOW()),  -- Karma POB Lee Know (doublon)
(3,23,'possede',1,NOW()),  -- Karma POB Hyunjin
(3,34,'doublon',2,NOW());  -- Karma Selfie Felix (doublon)

-- ============================================================
-- WISHLIST LILIA — cartes qu'elle veut (que Mia ou Yuna ont en doublon)
-- ============================================================
INSERT INTO wishlist (utilisateur_id, photocard_id, date_ajout) VALUES
(1,23,NOW()),  -- Karma POB Hyunjin (Mia en a)
(1,20,NOW());  -- Karma POB Lee Know (Yuna en a en doublon)

-- ============================================================
-- WISHLIST MIA — cartes qu'elle veut (que Lilia a en doublon)
-- ============================================================
INSERT INTO wishlist (utilisateur_id, photocard_id, date_ajout) VALUES
(2,27,NOW()),  -- Karma POB I.N (Lilia en a)
(2,29,NOW());  -- Karma POB I.N 3 (Lilia en a en triple)

-- ============================================================
-- WISHLIST YUNA — cartes qu'elle veut (que Lilia a)
-- ============================================================
INSERT INTO wishlist (utilisateur_id, photocard_id, date_ajout) VALUES
(3,25,NOW()),  -- Karma POB Felix (Lilia en a)
(3,2,NOW());   -- Mixtape Making Lee Know
