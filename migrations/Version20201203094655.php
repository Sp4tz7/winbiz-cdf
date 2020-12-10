<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203094655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE winbiz_main_id winbiz_main_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF1BA7C54 FOREIGN KEY (winbiz_main_code_id) REFERENCES product_template (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF1BA7C54 ON product (winbiz_main_code_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF1BA7C54');
        $this->addSql('DROP INDEX IDX_D34A04ADF1BA7C54 ON product');
        $this->addSql('ALTER TABLE product CHANGE winbiz_main_code_id winbiz_main_id INT NOT NULL');
    }
}
