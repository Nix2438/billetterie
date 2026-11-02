<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261102160503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, date_achat DATETIME NOT NULL, user_id INT NOT NULL, rencontre_id INT NOT NULL, INDEX IDX_1F034AF6A76ED395 (user_id), INDEX IDX_1F034AF66CFC0818 (rencontre_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, logo VARCHAR(255) DEFAULT NULL, stade_id INT DEFAULT NULL, INDEX IDX_B8EE38726538AB43 (stade_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, prix NUMERIC(6, 2) NOT NULL, places_en_vente INT NOT NULL, club_domicile_id INT NOT NULL, club_exterieur_id INT NOT NULL, stade_id INT NOT NULL, INDEX IDX_460C35ED4B8307F6 (club_domicile_id), INDEX IDX_460C35EDDD413D80 (club_exterieur_id), INDEX IDX_460C35ED6538AB43 (stade_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE stade (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, capacite VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF66CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38726538AB43 FOREIGN KEY (stade_id) REFERENCES stade (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED4B8307F6 FOREIGN KEY (club_domicile_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDDD413D80 FOREIGN KEY (club_exterieur_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED6538AB43 FOREIGN KEY (stade_id) REFERENCES stade (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6A76ED395');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF66CFC0818');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38726538AB43');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED4B8307F6');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDDD413D80');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED6538AB43');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE stade');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
