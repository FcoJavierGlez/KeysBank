<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Back</button></a></div>
        <h3>ADD</h3>
        <div</div>
    </div>
    <div class='account scroll'>
        <div class="<?php if ($addedAcount || $failuredAcount) echo $addedAcount ? "win_added_acc" : "fail_added_acc"; else echo 'hidden' ?>" >
            <div><?php echo $addedAcount ? "Added account succesfully" : "Add account failed"; ?></div>
            <div>
                <a href="accounts.php?add">
                    <button class="accept"><?php echo $addedAcount ? "New Account" : "Accept" ?></button>
                </a>
            </div>
        </div>
        <article <?php echo $addedAcount || $failuredAcount ? "class='hidden'" : "class=''"; ?>>
            <div class="basic-info">
                <form id="form-add" action="accounts.php?add" method="POST">
                    <fieldset class="select_platform">
                        <legend>Platform</legend>
                        <div class="div_select">
                            <div>Categories:</div>
                            <select name="categories" id="categories"></select>
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                        <div class="div_select">
                            <div>Platforms:</div>
                            <select name="subcategories" id="subcategories">
                                <option value="">-- Choice an option --</option>
                            </select>
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Account data</legend>
                        <div class="div_input">
                            <div>Account name:</div>
                            <input type="text" name="name" id="name" class="required" placeholder="required (*)">
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                        <div id="acc_name_rep" class="hidden"></div>
                        <!-- PASSWORD -->
                        <fieldset class="password">
                            <legend>Password</legend>
                            <div class="div_input">
                                <div>Password:</div>
                                <div class="div_pass">
                                    <div id="shps" class="eye">
                                        <input type="checkbox" name="shps">
                                    </div>
                                    <input type="password" name="pass" id="pass" class="required" placeholder="required (*)">
                                </div>
                                <div class="special_message">
                                    <span></span>
                                </div>
                            </div>
                            <div class="div_input">
                                <div>
                                    Repeat password:
                                </div>
                                <div class="div_pass">
                                    <div id="shpsr" class="eye">
                                        <input type="checkbox" name="shpsr">
                                    </div>
                                    <input type="password" name="pswd_rep" id="pass_rep" class="required" placeholder="required (*)">
                                </div>
                                <div class="special_message">
                                    <span class="dangerous"></span>
                                </div>
                            </div>
                            <!-- GEN PASS -->
                            <div class="div_gen_pass">
                                <label class="bold text-error div_checkbox"><input type="checkbox" id="use_generate"><div>Use generate password system</div></label>
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
                            <div class="div_input">
                                <div>
                                    URL / IP:
                                </div>
                                <div class="div_pass">
                                    <div id="shurl" class="eye">
                                        <input type="checkbox" name="shurl">
                                    </div>
                                    <input type="text" name="url" id="url" placeholder="OPTIONAL">
                                </div>
                            </div>
                            <div class="div_textarea">
                                <div>
                                    Notes (Visible info):
                                </div>
                                <div class="div_pass">
                                    <div id="shnotes" class="eye">
                                        <input type="checkbox" name="shnotes">
                                    </div>
                                    <textarea name="notes" id="notes" placeholder="OPTIONAL" maxlength="255"></textarea>
                                </div>
                                <div></div>
                                <span class="display_textarea_char">0/255</span>
                            </div>
                            <div class="div_textarea">
                                <div>
                                    Sensible info (Hidden info):
                                </div>
                                <div class="div_pass">
                                    <div id="shinfo" class="eye">
                                        <input type="checkbox" name="shinfo">
                                    </div>
                                    <textarea name="info" id="info" placeholder="OPTIONAL" maxlength="255"></textarea>
                                </div>
                                <div></div>
                                <span class="display_textarea_char">0/255</span>
                            </div>
                        </fieldset>
                    </fieldset>
                    <div class="special_message">
                        <span class="dangerous"></span>
                    </div>
                    <input type="submit" name ="add_account" id="save" value="Save" class="accept">
                </form>
            </div>
        </article>
    </div>
    </section>