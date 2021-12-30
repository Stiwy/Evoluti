<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230094804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission ADD user_id INT DEFAULT NULL, ADD invoice_deadline_date DATE DEFAULT NULL, ADD invoice_last_date DATE DEFAULT NULL, ADD status VARCHAR(255) NOT NULL, ADD insert_date DATETIME NOT NULL, ADD updated_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_9067F23CA76ED395 ON mission (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA76ED395');
        $this->addSql('DROP INDEX IDX_9067F23CA76ED395 ON mission');
        $this->addSql('ALTER TABLE mission DROP user_id, DROP invoice_deadline_date, DROP invoice_last_date, DROP status, DROP insert_date, DROP updated_date');
    }
}
