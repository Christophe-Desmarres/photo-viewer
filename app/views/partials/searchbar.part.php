    <div class="header--searchbar__home">

        <div class="select__choice">
            <label for="professor">Professeur</label>
            <select name="professor" id="professor" onchange="search()">
                <option value="all" selected>-- tous --</option>
                <option value="Carl">Carl Portal</option>
                <option value="Bruno">Bruno Vandelli</option>
                <option value="Guillaume">Guillaume Lorentz</option>
                <option value="Anthony">Anthony Despras</option>
            </select>
        </div>

        <div class="select__choice">
            <label for="level">Niveau</label>
            <select name="level" id="level" onchange="search()">
                <option value="all" selected>-- tous --</option>
                <option value="Inter">Inter</option>
                <option value="Avancé">Avancé</option>
            </select>
        </div>

        <div class="select__choice">
            <label for="day">Jour</label>
            <select name="day" id="day" onchange="search()">
                <option value="all" selected>-- tous --</option>
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
            </select>
        </div>
        
        
    </div>
