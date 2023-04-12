<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412095321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, alternative_text VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, caption VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guide ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guide ADD CONSTRAINT FK_CA9EC7353DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_CA9EC7353DA5256D ON guide (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guide DROP FOREIGN KEY FK_CA9EC7353DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP INDEX IDX_CA9EC7353DA5256D ON guide');
        $this->addSql('ALTER TABLE guide DROP image_id');
    }
}
