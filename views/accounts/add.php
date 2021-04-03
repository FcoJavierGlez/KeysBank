<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Back</button></a></div>
        <h3>ADD</h3>
        <div</div>
    </div>
    <div class='result scroll'>
        <article>
            <!-- <div class='platform'>
                <img src="<?php echo '../img/platform/'.normalizeString($result_search[0]['name_platform']).'.png'; ?>" alt="<?php echo 'Logo '.$result_search[0]['name_platform']; ?>">
                <h3><?php echo $result_search[0]['name_platform']; ?>:</h3>
            </div> -->
            <div class='basic-info'>
                <form id="form-add" action="accounts.php?add" method="POST">
                    <fieldset class="select_platform">
                        <legend>Platform</legend>
                        <div class="div_select">
                            <div>
                                Categories:
                            </div>
                            <select name="categories" id="categories"></select>
                        </div>
                        <div class="div_select">
                            <div>
                                Platforms: 
                            </div>
                            <select name="subcategories" id="subcategories">
                                <option value="">-- Choice an option --</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Account data</legend>
                        <div class="div_select">
                            <div>
                                Account name:
                            </div>
                            <input type="text" name="name" id="name">
                            <span></span>
                        </div>
                        <!-- PASSWORD -->
                        <fieldset class="password">
                            <legend>Password</legend>
                            <div class="div_select">
                                <div>
                                    Password:
                                </div>
                                <div class="div_pass">
                                    <div id="shps" class="eye">
                                        <input type="checkbox" name="shps">
                                    </div>
                                    <input type="password" name="pass" id="pass">
                                </div>
                                <div class="spacial_message">
                                    <span id="strong_password"></span>
                                </div>
                            </div>
                            <div class="div_select">
                                <div>
                                    Repeat password:
                                </div>
                                <div class="div_pass">
                                    <div id="shpsr" class="eye">
                                        <input type="checkbox" name="shpsr">
                                    </div>
                                    <input type="password" name="pass_rep" id="pass_rep">
                                </div>
                                <span></span>
                            </div>
                            <!-- GEN PASS -->
                            <div class="div_gen_pass">
                                <label class="bold text-error div_pass"><input type="checkbox" id="use_generate"><div>Use generate password system</div></label>
                            </div>
                            <fieldset id="gen_panel" class="hidden">
                                <legend>Generate password system</legend>
                                <div>
                                    <label class="bold text-green"><input type="checkbox" id="special_char" checked>Special characters</label>
                                </div>
                                <div>
                                    <label><input type="number" min="6" max="64" value="20" id="number_char">Password length (Recommended: 20)</label>
                                </div>
                                <div class="div_gen-pass_button">
                                    <button id="gen_pass" class="accept">Accept</button>
                                </div>
                            </fieldset>
                        </fieldset>
                        <!-- END PASSWORD -->
                        <fieldset>
                            <legend>Aditional info</legend>
                            <div class="div_select">
                                <div>
                                    URL:
                                </div>
                                <div class="div_pass">
                                    <div id="shpsr" class="eye">
                                        <input type="checkbox" name="shpsr">
                                    </div>
                                    <input type="password" name="url" id="url">
                                </div>
                                <span></span>
                            </div>
                            <div class="div_select">
                                <div>
                                    Notes (Visible info):
                                </div>
                                <div class="div_pass">
                                    <div id="shpsr" class="eye">
                                        <input type="checkbox" name="shpsr">
                                    </div>
                                    <input type="password" name="notes" id="notes">
                                </div>
                                <span></span>
                            </div>
                            <div class="div_select">
                                <div>
                                    Sensible info (Hidden info):
                                </div>
                                <div class="div_pass">
                                    <div id="shinfo" class="eye">
                                        <input type="checkbox" name="shinfo">
                                    </div>
                                    <input type="password" name="info" id="info">
                                </div>
                                <span></span>
                            </div>
                        </fieldset>
                    </fieldset>
                    <!-- <input type="hidden" name="search" value="<?php echo '?'.$_SESSION['user']['id'].'!'.$_GET['view']; ?>">
                    <div>
                        <b><u>Account</u>:</b>
                    </div>
                    <div>
                        <span><?php echo $result_search[0]['AES_DECRYPT(UNHEX(A.name_account),K.password)']; ?></span>
                    </div>
                    <div>
                        <b><u>Pass</u>:</b>
                    </div>
                    <div>
                        <span><?php echo replaceByCharacter($result_search[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'],'*'); ?></span>
                        <input type="submit" id="cp_pss" value="Copy">
                    </div> -->
                    <input type="submit" name ="" id="save" value="Save" class="accept">
                </form>
            </div>
        </article>
    </div>
    </section>