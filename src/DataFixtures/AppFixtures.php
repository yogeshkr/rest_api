<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BaseFixture;

class AppFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $item = new Item();
            $item->setItemName('item'.$i);
            $item->setItemCode(strtoupper('item').$i);
            $item->setItemDescription($this->faker->text());
            $item->setItemImage('dummy.jpeg');
            $item->setItemPrice($this->faker->randomNumber(3));
            $item->setIsActive($this->faker->boolean());
            $item->setCreatedAt($this->faker->dateTime());
            $item->setUpdatedAt($this->faker->dateTime());
            $manager->persist($item);

            for($j = 1; $j <= 3; $j++){
                $property = new Property();
                $property->setItem($item);
                $property->setPropertyName('Property'.$i.$j);
                $property->setPropertyCode(strtoupper('Property').$i.$j);
                $property->setPropertyDescription($this->faker->text());
                $property->setCreatedAt($this->faker->dateTime());
                $property->setUpdatedAt($this->faker->dateTime());
                $manager->persist($property);
            }
        }

        $manager->flush();
    }
}