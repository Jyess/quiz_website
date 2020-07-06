<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703123726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE resultat_reponse');
        $this->addSql('ALTER TABLE resultat ADD reponseId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2CF6DA21E FOREIGN KEY (reponseId) REFERENCES reponse (id)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE2CF6DA21E ON resultat (reponseId)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resultat_reponse (resultat_id INT NOT NULL, reponse_id INT NOT NULL, INDEX IDX_4A0462F2CF18BB82 (reponse_id), INDEX IDX_4A0462F2D233E95C (resultat_id), PRIMARY KEY(resultat_id, reponse_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resultat_reponse ADD CONSTRAINT FK_4A0462F2CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resultat_reponse ADD CONSTRAINT FK_4A0462F2D233E95C FOREIGN KEY (resultat_id) REFERENCES resultat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE2CF6DA21E');
        $this->addSql('DROP INDEX IDX_E7DB5DE2CF6DA21E ON resultat');
        $this->addSql('ALTER TABLE resultat DROP reponseId');
    }
}