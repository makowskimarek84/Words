<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170605185457 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, word_id INT DEFAULT NULL, nickname VARCHAR(255) NOT NULL, score INT NOT NULL, UNIQUE INDEX UNIQ_32993751E357438D (word_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751E357438D FOREIGN KEY (word_id) REFERENCES dictionary (id)');
        $this->addSql('ALTER TABLE dictionary DROP possibilities, DROP possibilities_counted');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE score');
        $this->addSql('ALTER TABLE dictionary ADD possibilities INT NOT NULL, ADD possibilities_counted TINYINT(1) NOT NULL');
    }
}
