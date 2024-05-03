<?php

namespace Database\Seeders;

use App\Models\Landlord\LeaseTemplate;
use Illuminate\Database\Seeder;

class LeaseTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaseTemplate::updateOrCreate([
            'name' => 'Contract standard de închiriere'
        ],[
            'body' => [
                '
                <br>
                <br>
                <p style="text-align: center;"><strong>CONTRACT DE ÎNCHIRIERE</strong></p>
                <p style="text-align: center;">nr. :lease_number:</p>
                <br>
                <br>
                <br>
                <p>Încheiat astăzi <strong>:contract_date:</strong></p>
                <br>
                <p>Între subsemnaţii:</p>
                <p>
                    <ol>
                        <li style="text-indent: 24px;text-align: justify;">I. <strong>:landlord_name:</strong> domiciliat(ă) în <strong>:landlord_address:</strong> posesor a B.I/C.I. seria <strong>:landlord_ci_serie:</strong> nr. <strong>:landlord_ci_numar:</strong> eliberat de <strong>:landlord_ci_issued_by:</strong> la data de <strong>:landlord_ci_issued_at:</strong> în calitate de proprietar al imobilului situat la adresa <strong>:property_address:</strong></li>
                        <li style="text-indent: 24px;text-align: justify;">II. <strong>:tenant_name:</strong> domiciliat(ă) în <strong>:tenant_address:</strong> posesor a B.I/C.I. seria <strong>:tenant_ci_serie:</strong> nr. <strong>:tenant_ci_numar:</strong> eliberat de <strong>:tenant_ci_issued_by:</strong> la data de <strong>:tenant_ci_issued_at:</strong> în calitate de chiriaș</li>
                    </ol>
                </p>
                <br>
                <p style="text-align: justify;">Primul în calitate de proprietar închiriez, iar al doilea în calitate de chiriaş iau în chirie imobilul situat la adresa <strong>:property_address:</strong> compus din <strong>:property_rooms:</strong> camere plus dependinţe, mobilate conform listei de inventar ce se va întocmi de către părţi la data intrării în imobil.</p>
                <br>
                <ol>
                    <li style="text-align: justify;">1. Termenul de închiriere este de la data de <strong>:lease_start_date:</strong> până la data de <strong>:lease_end_date:</strong> cu posibilitate de prelungire prin acordul ambelor părţi.</li>
                    <br>
                    <li style="text-align: justify;">2. Chiria lunară este de <strong>:rent_amount:</strong> <strong>:rent_currency:</strong>. Plata se face în numerar/prin virament bancar, până la data de <strong>:lease_due_day:</strong> a lunii pentru luna în curs.</li>
                    <br>
                    <li style="text-align: justify;">3. Părţile au convenit astfel: chiriaşul să plătească proprietarului suma de <strong>:deposit_amount:</strong> <strong>:deposit_currency:</strong> cu titlul de garanţie pentru plata chiriei și a cheltuielilor ce cad în sarcina chiriaşului şi care privesc imobilul ce face obiectul prezentului contract. Proprietarul se obligă ca la încetarea raporturilor dintre părţi, raporturi ce rezultă sau sunt consecinţa prezentului contract de închiriere, să restituie chiriaşului această sumă de bani.</li>
                    <br>
                    <li style="text-align: justify;">4. În momentul încheierii contractului s-a plătit de către chiriaş suma de <strong>:deposit_amount:</strong> <strong>:deposit_currency:</strong> reprezentând garanție</li>
                    <br>
                    <li style="text-align: justify;">5. Încetarea contractului se face:
                        <ul>
                            <li>- la împlinirea termenului prevăzut la art. 1,</li>
                            <li>- prin acordul ambelor părţi înainte de termen,</li>
                            <li>- prin denunțare unilaterală cu un preaviz de 30 zile calendaristice,</li>
                            <li>- prin reziliere în caz de nerespectare a clauzelor contractuale, fără alte formalități și fără trecerea vreunui termen.</li>
                        </ul>
                        În situaţia în care oricare din părţi nu respectă aceste condiţii va plăti celeilalte părţi despăgubiri în valoare de ______________
                    </li>
                    <br>
                    <li style="text-align: justify;">6. Obligațiile chiriașului:
                        <ul>
                            <li>- chiriaşul se obligă să folosească bunul închiriat conform destinaţiei sale, să nu tulbure liniştea proprietăţilor vecine prin folosinţa sa,</li>
                            <li>- va preda imobilul la finalul perioadei de locaţiune în condiţiile iniţiale preluării lui,</li>
                            <li>- nu va subînchiria imobilul,</li>
                            <li>- să plătească la termen/scadență cheltuielile de folosinţa a imobilului (apă, gaz, electricitate, etc),</li>
                            <li>- să respecte normele de prevenire a incendiilor şi să întreţină bunurile în folosinţă exclusive (instalaţii de apă, gaz metan, mobilier),</li>
                            <li>- să păstreze curăţenia şi să respecte normele de igienă în interiorul imobilului,</li>
                            <li>- să restituie imobilul la data expirării contractului sau la încetarea acestuia înainte de termen în condiţiile prezentului contract,</li>
                            <li>- să despăgubească proprietarul de eventualele daune produse imobilului sau bunurilor din interiorul acestuia din folosinţa sa,</li>
                            <li>- să nu schimbe destinaţia imobilului.</li>
                        </ul>
                    </li>
                    <br>
                    <li style="text-align: justify;">7. Obligațiile proprietarului:
                        <ul>
                            <li>- proprietarul se obligă să predea imobilul la data stabilită în contract în stare de folosinţă,</li>
                            <li>- proprietarul se obligă să asigure locatorului imobilul potrivit destinaţiei pentru care a fost închiriat,</li>
                            <li>- garantează chiriaşului împotriva viciilor ascunse ale imobilului,</li>
                            <li>- garantează pentru evicțiune.</li>
                        </ul>
                        Predarea imobilului către chiriaş se va face cel mai târziu la data de <strong>:lease_end_date:</strong>
                    </li>
                </ol>
                <br>
                <p style="text-align: justify;">Prezentul contract conţine trei pagini şi s-a încheiat în două exemplare, astăzi fiecare parte intrând în posesia unui exemplar din contract.</p>
                <br>
                <p>
                    La preluarea imobilului, aparatele de măsură aveau următoarele indexuri: <br />
                    Index contor apă caldă ________________________ <br />
                    Index contor apă rece   ________________________ <br />
                    Index energie electrică  ________________________ <br />
                </p>
                <br>
                <p style="text-align: justify;">La data închirierii la asociaţia de proprietari era de plată suma de _______________________</p>
                <br>
                <br>
                <br>
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <p>Proprietar</p>
                        <p><strong>:landlord_name:</strong></p><br>
                    </div>
                    <div>
                        <p>Chiriaș</p>
                        <p><strong>:tenant_name:</strong></p><br>
                    </div>
                </div>
                '
            ],
            'global' => true
        ]);
    }
}
