<?php

namespace Alri\Block\Test\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;



class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    protected function driver() {
     $options = (new ChromeOptions)->addArguments([
        //'--disable-gpu',
        //'--headless',
        '--window-size=1920,1080',
        'detach=true',
    ]);

    return RemoteWebDriver::create(
                    'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                            ChromeOptions::CAPABILITY, $options
                    )
    );
}

    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/package/block/info')
                    ->assertSee('block');
        });
    }
}
