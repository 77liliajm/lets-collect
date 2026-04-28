<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260428220912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_sortie DATE DEFAULT NULL, groupe_id INT NOT NULL, INDEX IDX_39986E437A45358C (groupe_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE album_version (id INT AUTO_INCREMENT NOT NULL, nom_version VARCHAR(150) NOT NULL, album_id INT NOT NULL, INDEX IDX_EACB8ED11137ABCF (album_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE echange (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, proposant_id INT NOT NULL, receveur_id INT NOT NULL, INDEX IDX_B577E3BF6522761A (proposant_id), INDEX IDX_B577E3BFB967E626 (receveur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, agence VARCHAR(150) DEFAULT NULL, date_debut DATE DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE idol (id INT AUTO_INCREMENT NOT NULL, nom_scene VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE photocard (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, raretes VARCHAR(100) DEFAULT NULL, nom_set VARCHAR(150) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE photocard_album_version (photocard_id INT NOT NULL, album_version_id INT NOT NULL, INDEX IDX_F4C5F38DE6400A8B (photocard_id), INDEX IDX_F4C5F38D43BC3420 (album_version_id), PRIMARY KEY (photocard_id, album_version_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE photocard_idol (photocard_id INT NOT NULL, idol_id INT NOT NULL, INDEX IDX_DF1A063AE6400A8B (photocard_id), INDEX IDX_DF1A063AE3B52F01 (idol_id), PRIMARY KEY (photocard_id, idol_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_collection (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(50) NOT NULL, date_ajout DATETIME NOT NULL, utilisateur_id INT NOT NULL, photocard_id INT NOT NULL, INDEX IDX_5B2AA3DEFB88E14F (utilisateur_id), INDEX IDX_5B2AA3DEE6400A8B (photocard_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(100) NOT NULL, email VARCHAR(180) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, photo_profil VARCHAR(255) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE wishlist (id INT AUTO_INCREMENT NOT NULL, date_ajout DATETIME NOT NULL, utilisateur_id INT NOT NULL, photocard_id INT NOT NULL, INDEX IDX_9CE12A31FB88E14F (utilisateur_id), INDEX IDX_9CE12A31E6400A8B (photocard_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E437A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE album_version ADD CONSTRAINT FK_EACB8ED11137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF6522761A FOREIGN KEY (proposant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFB967E626 FOREIGN KEY (receveur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE photocard_album_version ADD CONSTRAINT FK_F4C5F38DE6400A8B FOREIGN KEY (photocard_id) REFERENCES photocard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photocard_album_version ADD CONSTRAINT FK_F4C5F38D43BC3420 FOREIGN KEY (album_version_id) REFERENCES album_version (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photocard_idol ADD CONSTRAINT FK_DF1A063AE6400A8B FOREIGN KEY (photocard_id) REFERENCES photocard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photocard_idol ADD CONSTRAINT FK_DF1A063AE3B52F01 FOREIGN KEY (idol_id) REFERENCES idol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_collection ADD CONSTRAINT FK_5B2AA3DEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE user_collection ADD CONSTRAINT FK_5B2AA3DEE6400A8B FOREIGN KEY (photocard_id) REFERENCES photocard (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A31FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A31E6400A8B FOREIGN KEY (photocard_id) REFERENCES photocard (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E437A45358C');
        $this->addSql('ALTER TABLE album_version DROP FOREIGN KEY FK_EACB8ED11137ABCF');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BF6522761A');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFB967E626');
        $this->addSql('ALTER TABLE photocard_album_version DROP FOREIGN KEY FK_F4C5F38DE6400A8B');
        $this->addSql('ALTER TABLE photocard_album_version DROP FOREIGN KEY FK_F4C5F38D43BC3420');
        $this->addSql('ALTER TABLE photocard_idol DROP FOREIGN KEY FK_DF1A063AE6400A8B');
        $this->addSql('ALTER TABLE photocard_idol DROP FOREIGN KEY FK_DF1A063AE3B52F01');
        $this->addSql('ALTER TABLE user_collection DROP FOREIGN KEY FK_5B2AA3DEFB88E14F');
        $this->addSql('ALTER TABLE user_collection DROP FOREIGN KEY FK_5B2AA3DEE6400A8B');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A31FB88E14F');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A31E6400A8B');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE album_version');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE idol');
        $this->addSql('DROP TABLE photocard');
        $this->addSql('DROP TABLE photocard_album_version');
        $this->addSql('DROP TABLE photocard_idol');
        $this->addSql('DROP TABLE user_collection');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE wishlist');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
