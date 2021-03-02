<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216133646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, club_picture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_creation_club VARCHAR(255) NOT NULL, site_de_compet VARCHAR(255) DEFAULT NULL, reseaux_social VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B8EE3872A783F352 (club_picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club_picture_upload (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872A783F352 FOREIGN KEY (club_picture_id) REFERENCES club_picture_upload (id)');
        $this->addSql('ALTER TABLE profil_picture_upload DROP image_size');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872A783F352');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_picture_upload');
        $this->addSql('ALTER TABLE profil_picture_upload ADD image_size INT NOT NULL');
    }
}
