@extends('website.main')
@section('content')
@include('website.messages')
    <!--================================
                            =            Page Title            =
                            =================================-->
    <section class="page-title">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-9 offset-md-2 text-center">
                    <!-- Title text -->
                    <h3>Adatvédelmi és Adatkezelési Tájékoztató</h3>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    <!-- Main -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 mx-auto p-1">
                    <div class="terms-condition-content">
                        <h2 class="py-2">Általános</h2>
                        <p>Ez a dokumentum a Nyomozoo.hu (Üzemeltető), mint adatkezelő által a személyes adatok
                            vonatkozásában alkalmazott adatvédelmi és adatkezelési elveket rögzíti, illetve azokról nyújt
                            tájékoztatást. A szabályzat kialakítása során Üzemeltető a Polgári Törvénykönyvről szóló 2013.
                            évi V. törvény ("Ptk"), a 2011. évi CXII. törvény ("Infotörvény”), valamint az Európai Parlament
                            és Tanács 2016/679 Rendeletének ("GDPR") rendelkezéseit és iránymutatásait vette figyelembe.</p>
                        <p>Az itt rögzített irányelvek kizárólag az Üzemeltető által közvetlenül, jelen honlapon (Honlap)
                            át, végfelhasználók részére nyújtott szolgáltatások biztosítása keretében végzett
                            adatkezeléséről és adatvédelméről nyújt tájékoztatást, hatálya azonban nem terjed ki az Honlapon
                            elhelyezett külső hivatkozások révén megjelölt vagy elérhető, harmadik személyek által
                            üzemeltetett honlapokra és szolgáltatásokra. Utóbbiak vonatkozásában kérjük keresse fel a
                            megfelelő szolgáltató oldalát!</p>
                        <h3 class="py-3">Fogalmak</h3>
                        <p><label style="font-weight: bold">Adatkezelő:</label> aki az Adatkezelés céljait és eszközeit –
                            önállóan vagy másokkal együtt – meghatározza. A jelen Tájékoztatóban hivatkozott Szolgáltatások
                            esetében Adatkezelőnek a Nyomozoo.hu domain alatti oldal Kiadója minősül. </p>
                        <p><label style="font-weight: bold">Felhasználó:</label> az a természetes személy, aki a
                            Szolgáltatásokra regisztrál, és ennek keretében megad valamilyen Személyes adatot.</p>
                        <p><label style="font-weight: bold">Személyes adat:</label> bármilyen adat vagy információ, amely
                            alapján egy természetes személy Felhasználó - közvetett vagy közvetlen módon - azonosíthatóvá
                            válik. </p>
                        <p><label style="font-weight: bold">Adatfeldolgozó:</label> az a szolgáltató, aki az Adatkezelő
                            nevében személyes adatokat kezel.</p>
                        <p><label style="font-weight: bold">Szolgáltatás:</label> az Adatkezelő által üzemeltetett valamint
                            az Adatkezelő által a Honlapon keresztül biztosított szolgáltatás(ok).</p>
                        <h3 class="py-3">A kezelt személyes adatok</h3>
                        <p>Az Adatkezelő a Honlap által nyújtott Szolgáltatások biztosítása érdekében és során a következő
                            személyes adatokat kezeli: </p>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-dark">
                                <thead>
                                    <tr>
                                        <th>Adat</th>
                                        <th>Adatgyűjtés oka/célja</th>
                                        <th>Jogalap</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>Email-cím</td>
                                    <td>A Felhasználó fiókjának biztosítása (login), <br> valamint kommunikáció a
                                        Felhasználóval (értesítések, hírlevél)</td>
                                    <td>Felhasználó hozzájárulása</td>
                                    <tr>
                                        <td>Név (valódi és/vagy pszeudonim)</td>
                                        <td>A Felhasználó közzétételeinél és üzeneteinél a szerző megjelölése</td>
                                        <td>Felhasználó hozzájárulása</td>
                                    </tr>
                                    <tr>
                                        <td>Irányítószám</td>
                                        <td>Az elveszett háziállatok körzetének beazonosítása</td>
                                        <td>Felhasználó hozzájárulása</td>
                                    </tr>
                                    <tr>
                                        <td>Telefonszám</td>
                                        <td>A Felhasználó elérhetősége</td>
                                        <td>Felhasználó hozzájárulása</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p style="font-weight: bold">Felhasználó közzétételeiben és privát üzeneteiben, illetve az
                            Üzemeltető részére elérhetőségein (pl. emailben) küldött üzenetek részeként önkéntes módon egyéb
                            Személyes adatokat is közzétehet vagy megadhat. Ezen adatokat a Felhasználó hozzájárulása
                            alapján kezeljük, addig, amíg azok törlését a Felhasználó nem kéri. </p>
                        <p style="font-weight: bold">A felhasználói közzétételek és adatközlések vonatkozásában a
                            Felhasználó szavatol azért, hogy a Szolgáltatások igénybevétele során általa más személyekről
                            megadott vagy hozzáférhetővé tett személyes adat kezeléséhez az érintett személy hozzájárulását
                            beszerezte. A Felhasználó által a Szolgáltatásokba feltöltött, megosztott felhasználói
                            tartalomért minden felelősség a Felhasználót terheli. </p>
                        <h3 class="py-3">Az adatkezelés időtartama, hatálya</h3>
                        <p>A Felhasználó által megadott Személyes adatok kezelését Szolgáltató mindaddig folytatja, amíg a
                            Felhasználó a Szolgáltatásról – azzal a felhasználói fiókkal, amihez kapcsolódóan az adatok
                            rögzítésre kerültek – írásban nem kéri a Személyes adatok törlését, vagy amíg az adatokat a
                            Szolgáltató saját elhatározásából nem törli.</p>
                        <p>Jogellenes cselekmény vagy annak gyanúja esetében az Adatkezelő jogosult a Felhasználó Személyes
                            adatait törlési kérelme ellenére is a lefolytatandó eljárás időtartamára és céljára megőrizni
                            is.</p>
                        <p>A Honlap és Szolgáltatások üzemeltetése során keletkező, illetve rögzített, nem személyes jellegű
                            adatok a rendszer működésének biztosítása szempontjából indokolt időtartamig kerülnek tárolásra.
                            Az Adatkezelő garantálja, hogy ezen adatok egyéb Személyes adatokkal – a jogszabályok által
                            előírt tett esetek kivételével – össze nem kapcsolhatók.</p>
                        <h3 class="py-3">Sütik</h3>
                        <p>Az Nyomozoo.hu domain alatti bármely oldal használatával, automatikusan elfogadja a Felhasználó
                            az elengedhetetlen sütiket.</p>
                        <p>A Honlap működése részeként sütiket (cookie) is elhelyezhet a Felhasználó böngészőjében, amik
                            célja a Szolgáltatás használatának megkönnyítése és színvonvalának javítása. A sütik nem a
                            Szolgáltató, hanem a Felhasználó eszközein kerülnek tárolásra, és azokat a Felhasználó saját
                            hatáskörben, belátása szerint bármikor törölheti, sőt, elhelyezésüket eleve letilthatja a
                            böngészője erre szolgáló funkcióinak segítségével.</p>
                        <p>A Honlap böngészése közben a Felhasználó böngészőjében külső, harmadik felek (pl. Google
                            Analytics, Adverticum, stb.) is elhelyezhetnek sütiket. Ezen
                            sütikre az Üzemeltető semmilyen ráhatással nincs, azok tartalmához nem fér hozzá és azt nem
                            tárolja - így nem minősül adatkezelőnek sem. Ezen sütik tiltására és törlésére a korábban fent,
                            a Honlap által elhelyezett sütikről írtak ugyanúgy érvényesek.</p>
                        <h3 class="py-3">A felhasználók jogai a kezelt adatok vonatkozásában</h3>
                        <p>A Felhasználó a vonatkozásában kezelt Személyes adatok vonatkozásában az alább felsorolt jogokkal
                            rendelkezik. A jogokat a Felhasználó a Honlapon át, azonosítását (a fiókba történő belépését)
                            követően a Honlap megfelelő funkcióin keresztül gyakorolhatja. Ezen kívül írásban, az Adatkezelő
                            részére megküldött ajánlott levélben vagy az nyomozoo.hu@gmail.com címre küldött emailben is
                            gyakorolhatja itt felsorolt jogait.</p>
                        <p>Az utóbbi módok valamelyikén benyújtott kérelmet az Adatkezelő azonban csak akkor tekinti
                            hitelesnek és csak akkor teljesíti, ha az alapján a Felhasználó egyértelműen beazonosítható, és
                            bizonyítottnak tekinthető, hogy a kérést a Felhasználó saját maga nyújtotta be. A hitelesség
                            ellenőrzése érdekében Adatkezelő kérheti a Felhasználót személyazonosságának igazolására mielőtt
                            a kérés teljesítését megkezdené.</p>
                        <h6 class="py-3">Helyesbítési és módosítási jog</h6>
                        <p>A Felhasználó kérheti az Adatkezelők által kezelt Személyes adatainak helyesbítését vagy
                            módosítását. Ezen kívül a Felhasználó kérheti a hiányos Személyes adatok kiegészítését,
                            amennyiben az az adatok kezelési céljával összeegyeztethető.</p>
                        <h6 class="py-3">Törlési jog</h6>
                        <p>Felhasználó kérheti az Adatkezelő által kezelt Személyes adatainak törlését. A törlés
                            megtagadható a véleménynyilvánítás szabadságához és a tájékozódáshoz való jog gyakorlása
                            céljából, vagy ha a Személyes adatok kezelésére jogszabály felhatalmazást ad, valamint jogi
                            igények előterjesztéséhez, érvényesítéséhez, illetve védelméhez.</p>
                        <h3 class="py-3">Külső hivatkozások</h3>
                        <p>A Honlap használata során felhasználóink - többek között - a következő harmadik felek
                            szolgáltatásaival és sütijeivel találkozhatnak, amik a következő adatvédelmi szabályzatok
                            szerint működnek (a listát csak informatív jelleggel biztosítjuk):</p>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-dark">
                                <thead>
                                    <tr>
                                        <th>Szolgáltatás</th>
                                        <th>Típus</th>
                                        <th>Adatvédelmi tájékoztató</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>Google Analytics</td>
                                    <td>Mérés és analitika</td>
                                    <td><a href="https://policies.google.com/privacy?hl=hu">Itt</a></td>
                                    <tr>
                                        <td>Google Adsense</td>
                                        <td>Hirdetéskiszolgálás</td>
                                        <td><a href="https://policies.google.com/privacy?hl=hu">Itt</a></td>
                                    </tr>
                                    <tr>
                                        <td>Doubleclick</td>
                                        <td>Mérés és analitika</td>
                                        <td><a href="https://policies.google.com/privacy?hl=hu">Itt</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <label>Utolsó módosítás dátuma: 2021.11.10</label>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
