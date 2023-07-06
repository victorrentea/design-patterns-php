<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:25 PM
 */

namespace victor\training\architecture\infra\onrc;


use DateTime;

// uneori generam clase din swaggere LOR pe care ii chema
class ONRCLegalEntity
{
    private ?string $onrcId;
    private ?string $shortName;
    private ?string $extendedFullName;
    private ?DateTime $registrationDate;
    private ?DateTime $effectiveRegistrationDate;
    private ?string $euregno;
    private ?string $mainEml;
    /* @var ONRCLegalEntityContactEmail[] */
    private array $emailAddresses = array();

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): ONRCLegalEntity
    {
        $this->shortName = $shortName;
        return $this;
    }

    public function getExtendedFullName(): string
    {
        return $this->extendedFullName;
    }

    public function setExtendedFullName(string $extendedFullName): ONRCLegalEntity
    {
        $this->extendedFullName = $extendedFullName;
        return $this;
    }

    public function getRegistrationDate(): ?DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(DateTime $registrationDate): ONRCLegalEntity
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }

    public function getOnrcId(): string
    {
        return $this->onrcId;
    }

    public function setOnrcId(string $onrcId): ONRCLegalEntity
    {
        $this->onrcId = $onrcId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMainEml()
    {
        return $this->mainEml;
    }

    /**
     * @param mixed $mainEml
     * @return ONRCLegalEntity
     */
    public function setMainEml($mainEml)
    {
        $this->mainEml = $mainEml;
        return $this;
    }

    /**
     * @return ONRCLegalEntityContactEmail[]
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * @param ONRCLegalEntityContactEmail[] $emailAddresses
     * @return ONRCLegalEntity
     */
    public function setEmailAddresses(array $emailAddresses): ONRCLegalEntity
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }

    public function getEffectiveRegistrationDate(): DateTime
    {
        return $this->effectiveRegistrationDate;
    }

    public function setEffectiveRegistrationDate(DateTime $effectiveRegistrationDate): void
    {
        $this->effectiveRegistrationDate = $effectiveRegistrationDate;
    }

    /**
     * @return string|null
     */
    public function getEuregno(): ?string
    {
        return $this->euregno;
    }

    /**
     * @param string|null $euregno
     */
    public function setEuregno(?string $euregno): void
    {
        $this->euregno = $euregno;
    }


}