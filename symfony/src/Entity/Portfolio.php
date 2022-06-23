<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $birthDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 50)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $pinterest;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $linkedin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $instagram;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $facebook;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $twitter;

    #[ORM\Column(type: 'string', length: 1023, nullable: true)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'portfolio', targetEntity: Reference::class, cascade: ['persist'])]
    private $_references;

    #[ORM\OneToMany(mappedBy: 'portfolio', targetEntity: Education::class, cascade: ['persist'])]
    private $educations;

    #[ORM\OneToMany(mappedBy: 'portfolio', targetEntity: WorkExperience::class, cascade: ['persist'])]
    private $workExperiences;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $introduction;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $enthusiasm;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $englishLevel;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $yearsOfExperience;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $awardsWon;

    public function __construct()
    {
        $this->_references = new ArrayCollection();
        $this->educations = new ArrayCollection();
        $this->workExperiences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPinterest(): ?string
    {
        return $this->pinterest;
    }

    public function setPinterest(?string $pinterest): self
    {
        $this->pinterest = $pinterest;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Reference>
     */
    public function getReferences(): Collection
    {
        return $this->_references;
    }

    public function addReference(Reference $reference): self
    {
        if (!$this->_references->contains($reference)) {
            $this->_references[] = $reference;
            $reference->setPortfolio($this);
        }

        return $this;
    }

    public function removeReference(Reference $reference): self
    {
        if ($this->_references->removeElement($reference)) {
            // set the owning side to null (unless already changed)
            if ($reference->getPortfolio() === $this) {
                $reference->setPortfolio(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Education>
     */
    public function getEducations(): Collection
    {
        return $this->educations;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->educations->contains($education)) {
            $this->educations[] = $education;
            $education->setPortfolio($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->educations->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getPortfolio() === $this) {
                $education->setPortfolio(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WorkExperience>
     */
    public function getWorkExperiences(): Collection
    {
        return $this->workExperiences;
    }

    public function addWorkExperience(WorkExperience $workExperience): self
    {
        if (!$this->workExperiences->contains($workExperience)) {
            $this->workExperiences[] = $workExperience;
            $workExperience->setPortfolio($this);
        }

        return $this;
    }

    public function removeWorkExperience(WorkExperience $workExperience): self
    {
        if ($this->workExperiences->removeElement($workExperience)) {
            // set the owning side to null (unless already changed)
            if ($workExperience->getPortfolio() === $this) {
                $workExperience->setPortfolio(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getEnthusiasm(): ?int
    {
        return $this->enthusiasm;
    }

    public function setEnthusiasm(?int $enthusiasm): self
    {
        $this->enthusiasm = $enthusiasm;

        return $this;
    }

    public function getEnglishLevel(): ?int
    {
        return $this->englishLevel;
    }

    public function setEnglishLevel(?int $englishLevel): self
    {
        $this->englishLevel = $englishLevel;

        return $this;
    }

    public function getYearsOfExperience(): ?int
    {
        return $this->yearsOfExperience;
    }

    public function setYearsOfExperience(?int $yearsOfExperience): self
    {
        $this->yearsOfExperience = $yearsOfExperience;

        return $this;
    }

    public function getAwardsWon(): ?int
    {
        return $this->awardsWon;
    }

    public function setAwardsWon(?int $awardsWon): self
    {
        $this->awardsWon = $awardsWon;

        return $this;
    }

    public static function placeholder(): Portfolio
    {
        $education1 = (new Education())
            ->setTitle('UTM License grade')
            ->setDescription('4 years of studying computer science at technical university of Moldova')
            ->setDiplomaName('Computer science bachelor degree')
            ->setYear(2020);

        $education2 = (new Education())
            ->setTitle('USV Master grade')
            ->setDescription('2 years of studying and getting awesome skills at Technical University of Suceava "Stefan cel Mare"')
            ->setDiplomaName('Computer science master degree')
            ->setYear(2022);

        $job = (new WorkExperience())
            ->setDescription('Working on different projects and gaining precious experience in developing complex and strong architectures of web apps. Participating in audit projects and estimating tasks as well as guiding new comers.')
            ->setTitle('Full Stack web developer at Tekoway')
            ->setStartDate(new \DateTime('10-09-2018'))
            ->setEndDate(null)
            ->setPost('Web Developer');

        return (new self())
            ->setFirstName('Mr.')
            ->setLastName('Student')
            ->setEmail('student@me')
            ->setAddress('Nowhere')
            ->setAwardsWon(0)
            ->setBirthDate((new \DateTime())->modify('-26 years'))
            ->setEnglishLevel(100)
            ->setEnthusiasm(100)
            ->setFacebook('https://facebook.com')
            ->setImage('avatar.png')
            ->setInstagram('https://instagram.com')
            ->setIntroduction('I am a student and a professional developer using Symfony and Angular stack. I also have skills with git, markdown, sql and no-sql.')
            ->setLinkedin('https://linkedin.com')
            ->setPhone('+373 60 123 456')
            ->setPinterest('https://pinterest.com')
            ->setTwitter('https://twitter.com')
            ->setYearsOfExperience(3)
            ->addEducation($education1)
            ->addEducation($education2)
            ->addWorkExperience($job)
            ->addReference(
                (new Reference())->setAuthor('Sudacevschi Viorica')
                    ->setDescription('Very good student, we are very proud that we have such students at our university.')
                    ->setAuthorPost('Principal')
            );
    }
}
