<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810072642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seance_qualite (seance_id INT NOT NULL, qualite_id INT NOT NULL, INDEX IDX_B0C1099EE3797A94 (seance_id), INDEX IDX_B0C1099EA6338570 (qualite_id), PRIMARY KEY(seance_id, qualite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seance_qualite ADD CONSTRAINT FK_B0C1099EE3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance_qualite ADD CONSTRAINT FK_B0C1099EA6338570 FOREIGN KEY (qualite_id) REFERENCES qualite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE place ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_741D53CDB83297E7 ON place (reservation_id)');
        $this->addSql('ALTER TABLE reservation ADD seance_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955E3797A94 ON reservation (seance_id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('ALTER TABLE salle ADD cinema_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CB4CB84B6 FOREIGN KEY (cinema_id) REFERENCES cinema (id)');
        $this->addSql('CREATE INDEX IDX_4E977E5CB4CB84B6 ON salle (cinema_id)');
        $this->addSql('ALTER TABLE seance ADD salle_id INT DEFAULT NULL, ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EDC304035 ON seance (salle_id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0E567F5183 ON seance (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance_qualite DROP FOREIGN KEY FK_B0C1099EE3797A94');
        $this->addSql('ALTER TABLE seance_qualite DROP FOREIGN KEY FK_B0C1099EA6338570');
        $this->addSql('DROP TABLE seance_qualite');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande DROP user_id');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDB83297E7');
        $this->addSql('DROP INDEX IDX_741D53CDB83297E7 ON place');
        $this->addSql('ALTER TABLE place DROP reservation_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E3797A94');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP INDEX IDX_42C84955E3797A94 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP seance_id, DROP user_id');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CB4CB84B6');
        $this->addSql('DROP INDEX IDX_4E977E5CB4CB84B6 ON salle');
        $this->addSql('ALTER TABLE salle DROP cinema_id');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EDC304035');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E567F5183');
        $this->addSql('DROP INDEX IDX_DF7DFD0EDC304035 ON seance');
        $this->addSql('DROP INDEX IDX_DF7DFD0E567F5183 ON seance');
        $this->addSql('ALTER TABLE seance DROP salle_id, DROP film_id');
    }
}
