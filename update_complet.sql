-- ============================================================
-- ÉTAPE 1 : Insertion des cartes manquantes (ids 39 à 53)
-- ============================================================

-- Mixtape Making Version — membres manquants
INSERT INTO photocard (id, nom_set, image, raretes) VALUES
(39, 'Mixtape • Making • Changbin', NULL, 'common'),
(40, 'Mixtape • Making • Hyunjin',  NULL, 'common'),
(41, 'Mixtape • Making • Han',      NULL, 'common'),
(42, 'Mixtape • Making • Seungmin', NULL, 'common'),
(43, 'Mixtape • Making • I.N',      NULL, 'common');

-- Mixtape Selfie Version — membres manquants
INSERT INTO photocard (id, nom_set, image, raretes) VALUES
(44, 'Mixtape • Selfie • Bang Chan', NULL, 'common'),
(45, 'Mixtape • Selfie • Changbin',  NULL, 'common'),
(46, 'Mixtape • Selfie • Hyunjin',   NULL, 'common'),
(47, 'Mixtape • Selfie • Felix',     NULL, 'common'),
(48, 'Mixtape • Selfie • I.N',       NULL, 'common');

-- I Am NOT Selfie — Hyunjin et Han manquants
INSERT INTO photocard (id, nom_set, image, raretes) VALUES
(49, 'I Am NOT • Selfie • Hyunjin', NULL, 'common'),
(50, 'I Am NOT • Selfie • Han',     NULL, 'common');

-- I Am NOT Childhood — Hyunjin et Seungmin manquants
INSERT INTO photocard (id, nom_set, image, raretes) VALUES
(51, 'I Am NOT • Childhood • Hyunjin',  NULL, 'common'),
(52, 'I Am NOT • Childhood • Seungmin', NULL, 'common');

-- Karma Selfie — Bang Chan manquant
INSERT INTO photocard (id, nom_set, image, raretes) VALUES
(53, 'Karma • Selfie • Bang Chan', NULL, 'common');

-- ============================================================
-- ÉTAPE 2 : Liaisons album_version
-- ============================================================

-- Making Version id=1
INSERT INTO photocard_album_version (photocard_id, album_version_id) VALUES
(39,1),(40,1),(41,1),(42,1),(43,1);

-- Selfie Version Mixtape id=2
INSERT INTO photocard_album_version (photocard_id, album_version_id) VALUES
(44,2),(45,2),(46,2),(47,2),(48,2);

-- I Am NOT Selfie id=3
INSERT INTO photocard_album_version (photocard_id, album_version_id) VALUES
(49,3),(50,3);

-- I Am NOT Childhood id=4
INSERT INTO photocard_album_version (photocard_id, album_version_id) VALUES
(51,4),(52,4);

-- Karma Accordion id=5
INSERT INTO photocard_album_version (photocard_id, album_version_id) VALUES
(53,5);

-- ============================================================
-- ÉTAPE 3 : Liaisons idol
-- ============================================================

-- Mixtape Making manquants
-- Changbin=3, Hyunjin=4, Han=5, Seungmin=7, I.N=8
INSERT INTO photocard_idol (photocard_id, idol_id) VALUES
(39,3),(40,4),(41,5),(42,7),(43,8);

-- Mixtape Selfie manquants
-- Bang Chan=1, Changbin=3, Hyunjin=4, Felix=6, I.N=8
INSERT INTO photocard_idol (photocard_id, idol_id) VALUES
(44,1),(45,3),(46,4),(47,6),(48,8);

-- I Am NOT Selfie manquants
-- Hyunjin=4, Han=5
INSERT INTO photocard_idol (photocard_id, idol_id) VALUES
(49,4),(50,5);

-- I Am NOT Childhood manquants
-- Hyunjin=4, Seungmin=7
INSERT INTO photocard_idol (photocard_id, idol_id) VALUES
(51,4),(52,7);

-- Karma Selfie Bang Chan=1
INSERT INTO photocard_idol (photocard_id, idol_id) VALUES
(53,1);

-- ============================================================
-- ÉTAPE 4 : Mise à jour de TOUTES les images
-- ============================================================

-- Mixtape Making Version
UPDATE photocard SET image = 'photocards/mixtape_making_bangchan.jpeg' WHERE id = 1;
UPDATE photocard SET image = 'photocards/mixtape_making_leeknow.jpeg'  WHERE id = 2;
UPDATE photocard SET image = 'photocards/mixtape_making_felix.jpeg'    WHERE id = 3;
UPDATE photocard SET image = 'photocards/mixtape_making_changbin.jpeg' WHERE id = 39;
UPDATE photocard SET image = 'photocards/mixtape_making_hyunjin.jpeg'  WHERE id = 40;
UPDATE photocard SET image = 'photocards/mixtape_making_han.jpeg'      WHERE id = 41;
UPDATE photocard SET image = 'photocards/mixtape_making_seugmin.jpeg'  WHERE id = 42;
UPDATE photocard SET image = 'photocards/mixtape_making_in.jpeg'       WHERE id = 43;

-- Mixtape Selfie Version
UPDATE photocard SET image = 'photocards/mixtape_selfie_han.jpeg'      WHERE id = 4;
UPDATE photocard SET image = 'photocards/mixtape_selfie_leeknow.jpeg'  WHERE id = 5;
UPDATE photocard SET image = 'photocards/mixtape_selfie_seungmin.jpeg' WHERE id = 6;
UPDATE photocard SET image = 'photocards/mixtape_selfie_chan.jpeg'     WHERE id = 44;
UPDATE photocard SET image = 'photocards/mixtape_selfie_changbin.jpeg' WHERE id = 45;
UPDATE photocard SET image = 'photocards/mixtape_selfie_hyunjin.jpeg'  WHERE id = 46;
UPDATE photocard SET image = 'photocards/mixtape_selfie_felix.jpeg'    WHERE id = 47;
UPDATE photocard SET image = 'photocards/mixtape_selfie_in.jpeg'       WHERE id = 48;

-- I Am NOT Selfie Version
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_chan.jpeg'     WHERE id = 7;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_leeknow.jpeg' WHERE id = 8;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_chanbin.jpeg' WHERE id = 9;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_felix.jpeg'   WHERE id = 10;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_seungmin.jpeg'WHERE id = 11;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_in.jpeg'      WHERE id = 12;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_hyunjin.jpeg' WHERE id = 49;
UPDATE photocard SET image = 'photocards/skz_iamnot_selfie_han.jpeg'     WHERE id = 50;

-- I Am NOT Childhood Version
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_chan.jpeg'     WHERE id = 13;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_leeknow.jpeg' WHERE id = 14;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_changbin.jpeg'WHERE id = 15;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_han.jpeg'     WHERE id = 16;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_felix.jpeg'   WHERE id = 17;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_in.jpeg'      WHERE id = 18;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_hyunjin.jpeg' WHERE id = 51;
UPDATE photocard SET image = 'photocards/skz_iamnot_childhood_seungmin.jpeg'WHERE id = 52;

-- Karma POB Selfie Version
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_chan.jpeg'     WHERE id = 19;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_leeknow.jpeg' WHERE id = 20;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_leeknow.jpeg' WHERE id = 21;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_changbin.jpeg'WHERE id = 22;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_hyunjin.jpeg' WHERE id = 23;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_han.jpeg'     WHERE id = 24;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_felix.jpeg'   WHERE id = 25;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_seungmin.jpeg'WHERE id = 26;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_in.jpeg'      WHERE id = 27;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_in.jpeg'      WHERE id = 28;
UPDATE photocard SET image = 'photocards/skz_karma_pobselfie_in.jpeg'      WHERE id = 29;

-- Karma Selfie Version
UPDATE photocard SET image = 'photocards/skz_karma_selfie_leeknow.jpeg'  WHERE id = 30;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_changbin.jpeg' WHERE id = 31;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_hyunjin.jpeg'  WHERE id = 32;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_han.jpeg'      WHERE id = 33;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_felix.jpeg'    WHERE id = 34;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_seungmin.jpeg' WHERE id = 35;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_in.jpeg'       WHERE id = 36;
UPDATE photocard SET image = 'photocards/skz_karma_selfie_chan.jpeg'     WHERE id = 53;

-- BTS
UPDATE photocard SET image = 'photocards/bts_lyher_making_jimin.jpg'       WHERE id = 37;

-- Pentagon
UPDATE photocard SET image = 'photocards/ptgn_positive_making_wooseok.jpg' WHERE id = 38;
