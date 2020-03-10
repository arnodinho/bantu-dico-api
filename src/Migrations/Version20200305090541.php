<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305090541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE french (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(255) NOT NULL, Description VARCHAR(255) DEFAULT NULL, Exemple VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, Type VARCHAR(30) NOT NULL, Language VARCHAR(10) DEFAULT NULL, Status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sango (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(255) NOT NULL, Description VARCHAR(255) DEFAULT NULL, Exemple VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, Type VARCHAR(30) NOT NULL, Language VARCHAR(10) DEFAULT NULL, Status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unknown (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(255) NOT NULL, source VARCHAR(255) NOT NULL, target VARCHAR(255) NOT NULL, origin VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE french_lingala (id INT AUTO_INCREMENT NOT NULL, french_id INT DEFAULT NULL, lingala_id INT DEFAULT NULL, user_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, Votes INT DEFAULT NULL, Likes INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, description_french VARCHAR(255) DEFAULT NULL, description_lingala VARCHAR(255) DEFAULT NULL, INDEX IDX_C5C405F37575B956 (french_id), INDEX IDX_C5C405F3D611B162 (lingala_id), INDEX IDX_C5C405F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE french_sango (id INT AUTO_INCREMENT NOT NULL, french_id INT DEFAULT NULL, sango_id INT DEFAULT NULL, user_id INT DEFAULT NULL, Votes INT DEFAULT NULL, status TINYINT(1) NOT NULL, Likes INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, description_french VARCHAR(255) DEFAULT NULL, description_sango VARCHAR(255) DEFAULT NULL, INDEX IDX_2A6E03B57575B956 (french_id), INDEX IDX_2A6E03B58995304B (sango_id), INDEX IDX_2A6E03B5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lingala (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(255) NOT NULL, Description VARCHAR(255) DEFAULT NULL, Exemple VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, Type VARCHAR(30) NOT NULL, Language VARCHAR(10) DEFAULT NULL, Status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, language VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE french_lingala ADD CONSTRAINT FK_C5C405F37575B956 FOREIGN KEY (french_id) REFERENCES french (id)');
        $this->addSql('ALTER TABLE french_lingala ADD CONSTRAINT FK_C5C405F3D611B162 FOREIGN KEY (lingala_id) REFERENCES lingala (id)');
        $this->addSql('ALTER TABLE french_lingala ADD CONSTRAINT FK_C5C405F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE french_sango ADD CONSTRAINT FK_2A6E03B57575B956 FOREIGN KEY (french_id) REFERENCES french (id)');
        $this->addSql('ALTER TABLE french_sango ADD CONSTRAINT FK_2A6E03B58995304B FOREIGN KEY (sango_id) REFERENCES sango (id)');
        $this->addSql('ALTER TABLE french_sango ADD CONSTRAINT FK_2A6E03B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE french_lingala DROP FOREIGN KEY FK_C5C405F37575B956');
        $this->addSql('ALTER TABLE french_sango DROP FOREIGN KEY FK_2A6E03B57575B956');
        $this->addSql('ALTER TABLE french_sango DROP FOREIGN KEY FK_2A6E03B58995304B');
        $this->addSql('ALTER TABLE french_lingala DROP FOREIGN KEY FK_C5C405F3A76ED395');
        $this->addSql('ALTER TABLE french_sango DROP FOREIGN KEY FK_2A6E03B5A76ED395');
        $this->addSql('ALTER TABLE french_lingala DROP FOREIGN KEY FK_C5C405F3D611B162');
        $this->addSql('DROP TABLE french');
        $this->addSql('DROP TABLE sango');
        $this->addSql('DROP TABLE unknown');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE french_lingala');
        $this->addSql('DROP TABLE french_sango');
        $this->addSql('DROP TABLE lingala');
        $this->addSql('DROP TABLE page');
    }
}
