
        <nav>
            <ul>
                <!-- display links for all currency_offerings -->
                <?php foreach($currency_offerings as $currency_offering) : ?>
                <li>
                    <a href="?currency_offering_id=<?php 
                              echo $currency_offering['currencyOfferingID']; ?>">
                        <?php echo $currency_offering['currencyOfferingTitle']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

