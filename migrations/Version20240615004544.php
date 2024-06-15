<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240615004544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_groups (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, public TINYINT(1) NOT NULL, INDEX IDX_C2F44E22A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', location_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', event_group_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, confirmation_needed TINYINT(1) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, registration_opening_date DATETIME NOT NULL, registration_closing_date DATETIME NOT NULL, image_name VARCHAR(50) DEFAULT NULL, public_location TINYINT(1) NOT NULL, INDEX IDX_5387574A64D218E (location_id), INDEX IDX_5387574AB8B83097 (event_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locations (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_groups ADD CONSTRAINT FK_C2F44E22A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A64D218E FOREIGN KEY (location_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AB8B83097 FOREIGN KEY (event_group_id) REFERENCES event_groups (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_groups DROP FOREIGN KEY FK_C2F44E22A76ED395');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A64D218E');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AB8B83097');
        $this->addSql('DROP TABLE event_groups');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE locations');
        $this->addSql('DROP TABLE users');
    }
}
