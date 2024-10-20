    <div style="width:100%;">
      <div style="display: inline; float: left; width=40%;">
      <form action = "?oldal=belep" method = "post">
        <fieldset>
          <legend>Bejelentkezés</legend><br>
          <input type="text" name="felhasznalo" placeholder="felhasználó" required><br><br>
          <input type="password" name="jelszo" placeholder="jelszó" required><br><br>
          <input type="submit" name="belepes" value="Belépés"><br><br>
          
        </fieldset>
      </form>
  </div><div style="display: inline-block; float: left; width:20%;" > Vagy </div>

    <div style="display: inline-block; float: left; width:40%;" >
    <form action = "?oldal=regisztral" method = "post">
      <fieldset>
        <legend>Regisztráció</legend>
       
        <input type="text" name="vezeteknev" placeholder="vezetéknév" required><br><br>
        <input type="text" name="utonev" placeholder="utónév" required><br><br>
        <input type="text" name="felhasznalo" placeholder="felhasználói név" required><br><br>
        <input type="password" name="jelszo" placeholder="jelszó" required><br><br>
        <input type="submit" name="regisztracio" value="Regisztráció"><br>
        
      </fieldset>
    </form>
  </div>
  </div>