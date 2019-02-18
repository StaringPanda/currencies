
        <nav>
            <ul>
                <!-- display links for all currencies -->
                <?php foreach($currencies as $currency) : ?>
                <li>
                    <a href="?currency_id=<?php 
                              echo $currency['currencyOfferingID']; ?>">
                        <?php echo $currency['currencyOfferingTitle']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

