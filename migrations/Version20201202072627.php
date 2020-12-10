<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202072627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, quantity INT DEFAULT NULL, item_code VARCHAR(50) NOT NULL, pictures LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, creation_date DATETIME NOT NULL, modification_date DATETIME DEFAULT NULL, availability_date DATETIME DEFAULT NULL, weight VARCHAR(20) DEFAULT NULL, status TINYINT(1) NOT NULL, name_fr VARCHAR(255) NOT NULL, name_de VARCHAR(255) DEFAULT NULL, name_it VARCHAR(255) DEFAULT NULL, name_en VARCHAR(255) DEFAULT NULL, description_fr LONGTEXT DEFAULT NULL, description_de LONGTEXT DEFAULT NULL, description_it LONGTEXT DEFAULT NULL, description_en LONGTEXT DEFAULT NULL, INDEX IDX_D34A04ADA23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA23B42D');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
    }
}
