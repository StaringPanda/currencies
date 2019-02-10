
        <nav>
            <ul>
                <!-- display links for all currencies -->
                <?php foreach($currencies as $currency) : ?>
                <li>
                    <a href="?currency_id=<?php 
                              echo $currency['currencyID']; ?>">
                        <?php echo $currency['currencyTitle']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

