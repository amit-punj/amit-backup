<!DOCTYPE html>
<html>
<head>
  <title>Rental Agreament</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <!-- <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300" rel="stylesheet"> -->

<style type="text/css">
  td{ height: 30px; }
  table{ width:100%; }
  strong{ color: #000; }
  .ml-30 {margin-left: 30px;}
  /*span { color: #000 !important; }*/
 /* @page {
      margin: 0cm 0cm;
  }*/
 /* body {
      margin-top: 3cm;
      margin-left: 2cm;
      margin-right: 2cm;
      margin-bottom: 2cm;
  }*/
 /* header {
      position: fixed;
      top: 0cm;
      left: 0cm;
      right: 0cm;
      height: 3cm;
  }*/

  /** Define the footer rules **/
 /* footer {
      position: fixed; 
      bottom: 0cm; 
      left: 0cm; 
      right: 0cm;
      height: 2cm;
  }*/
</style>
</head>
<body style="background-color: #fff;">
    <!-- <header>
        <img src="{{url('images/logo_new.png')}}" width="50%" style="margin-left:15px;" height="100%"/>
    </header>
    <footer>
        <img src="{{url('images/logo_new.png')}}" width="50%" style="margin-left:15px;" height="100%"/>
    </footer> -->
   <?php 
      // Helper::pr($data);
   ?>
    <!-- <div class="col-md-5" align="right">
      <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-danger">Convert into PDF</a>
    </div> -->
    <table style="margin: 0">
        <tr>
            <td>
              <span style="font-size: 14px; font-weight: 300;">RESIDENTIAL LEASE</span>
            </td>
        </tr>
        <tr>
          <td>
            <span>Between the undersigned</span>
          </td>
        </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Name:</span></td>
        <td><span style="color: red;">{{$data['lessor_name']}}</span></td>
        <td><span>ID Card / Passport Nr:</span></td>
        <td><span style="color: red;">{{$data['lessor_id']}}</span></td>
      </tr>
      <tr>
        <td><span>Street, Number:</span></td>
        <td><span style="color: red;">{{$data['lessor_address']}}</span></td>
        <td><span>Postal Code, Commune:</span></td>
        <td><span style="color: red;">{{$data['lessor_postal']}}</span></td>
      </tr>
      <tr>
        <td><span>Phone / Mobile:</span></td>
        <td><span style="color: red;">{{$data['lessor_phone']}}</span></td>
        <td><span>Email:</span></td>
        <td><span style="color: red;">{{$data['lessor_email']}}</span></td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Called the "LESSOR"</span></td>
      </tr>
      <tr>
        <td><span>And</span></td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Name:</span></td>
        <td><span style="color: red;">{{$data['lessee1_name']}}</span></td>
        <td><span>ID Card / Passport Nr:</span></td>
        <td><span style="color: red;">{{$data['lessee1_id']}}</span></td>
      </tr>
      <tr>
        <td><span>Street, Number:</span></td>
        <td><span style="color: red;">{{$data['lessee1_address']}}</span></td>
        <td><span>Postal Code, Commune:</span></td>
        <td><span style="color: red;">{{$data['lessee1_postal']}}</span></td>
      </tr>
      <tr>
        <td><span>Phone / Mobile:</span></td>
        <td><span style="color: red;">{{$data['lessee1_phone']}}</span></td>
        <td><span>Email:</span></td>
        <td><span style="color: red;">{{$data['lessee1_email']}}</span></td>
      </tr>
    </table>

    @if(isset($data['coTenant']) && count($data['coTenant']) > 0)
        @foreach($data['coTenant'] as $key => $value)
        <h3>+</h3>
        <table style="margin: 0;">
          <tr>
            <td><span>Name:</span></td>
            <td><span style="color: red;">{{$value['lessee_name']}}</span></td>
            <td><span>ID Card / Passport Nr:</span></td>
            <td><span style="color: red;">{{$value['lessee_id']}}</span></td>
          </tr>
          <tr>
            <td><span>Street, Number:</span></td>
            <td><span style="color: red;">{{$value['lessee_address']}}</span></td>
            <td><span>Postal Code, Commune:</span></td>
            <td><span style="color: red;">{{$value['lessee_postal']}}</span></td>
          </tr>
          <tr>
            <td><span>Phone / Mobile:</span></td>
            <td><span style="color: red;">{{$value['lessee_phone']}}</span></td>
            <td><span>Email:</span></td>
            <td><span style="color: red;">{{$value['lessee_email']}}</span></td>
          </tr>
        </table>
        @endforeach
    @endif

    <table style="margin: 0;">
      <tr>
        <td><span>Referred to as "LESSEE"</span></td>
      </tr>
      <tr>
        <td><span>Which are bound jointly and indivisibly, it has been agreed as follows</span></td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art1. OBJECT - DESTINATION</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The lessor gives lease to a lessee, a <strong>{{ $data['furnished'] }}</strong> <strong>{{ $data['unit_category'] }}</strong> hereinafter referred to as "PROPERTY", used as a <strong> {{$data['used']}} </strong> situated <strong> {{$data['unit_address']}}</strong> 
            <?php 
                if(!empty($data['building_name']))
                { ?>
                     in the building <strong>{{ $data['building_name'] }} </strong>
            <?php  } ?>
          </p>
        </td>
      </tr>
      <tr>
        <td>
          <p>
            including <strong> {{$data['unit_amenities']}} </strong>  well known to the taker who declares to have examined it and recognizes that it meets the standards of safety, salubrity and habitability, and is in good state of maintenance. Its destination cannot be changed without prior written agreement of the lessor. If the lessee allocates all or part of the leased property for professional purposes without the agreement of the lessor, the additional tax that may be levied by the lessee on the lessee's professional allocation will be by the lessor and will be due at the same time as the rent of the month following the request of the lessor. 
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 2. DURATION</span></td>
      </tr>
      <tr>
        <td><span>A. Lease of principal residence</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The lease is for a period of <strong>{{$data['contract_months']}}</strong>  taking place on <strong> {{$data['start_date']}}</strong>. The lease of a duration less than or equal to 3 years (short lease) can be extended in writing only once and under the same conditions, without being able to exceed a total duration of 3 years. The lease of a duration equal to or less than 3 years will terminate with payment notified by one or the other of the parties at least 3 months before the expiration of the agreed period. Concerning the lease of a duration of 9 years. the lessee can leave at any time, provided to notify the lessor leave of 3 months. During the first 3 years of the lease, however, he must pay the lessor an equal indemnity a;
          </p>
        </td>
      </tr>
      <tr>
            <td>- 3 months rent if he leaves during the first year,</td>
        </tr>
        <tr>
          <td>- 2 months rent if he leaves during the second year,</td>
        </tr>
        <tr>
            <td>- 1 month rent if he leaves during the third year,</td>
        </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>B. Secondary residence lease</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The lease is concluded for a fixed term of <strong>{{$data['contract_months']}}</strong> taking place on <strong>{{$data['start_date']}} </strong> And ending right on <strong> {{$data['end_date']}} </strong>
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 3. RENT</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The basic <strong>monthly </strong> rent is fixed at the sum of <strong> {{$data['rent']}} </strong> {{Helper::currencyType()}} . that the lessee is required to pay in advance by standing order so as to credit the lessor on the first day of each month. Until further notice, payments will be made to account number IBAN<strong> {{$data['lessor_account']}}</strong>.BIC <strong>{{$data['lessor_bic']}}</strong> from <strong>{{$data['lessor_name']}}</strong>
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 4. INDEXING THE RENT</span></td>
      </tr>
      <tr>
        <td>
          <span>Indexation due to the lessor on each anniversary date of the taking of the lease, by application of the following formula:</span></td>
      </tr>
      <tr>
        <td>
          <p><u style="margin-left: 2%;">Basic rent x new index</u><br>
                Basic index</p>
        </td>
      </tr>
      <tr>
        <td>
          The basic index is the month before the conclusion of the lease <strong>[MONTH BEFORE THE START OF THE CONTRACT]</strong>
        </td>
      </tr>
      <tr>
        <td>
          The new index, that of the month preceding the anniversary of the coming into force of the lease.
        </td>
      </tr>
      <tr>
        <td>
          The index at issue is the one currently named and calculated in accordance with the legislation. If this index is no longer published, the parties undertake to find in good faith an equivalent benchmark.
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 5. PRIVATE CONSUMPTION - COMMON LOADS</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The use and private consumption of water, electricity, gas, telephone, radio, television or other, and related expenses, subscriptions, provisions, placement and rental of meters are the responsibility of the lessee.
          </p>
          <p>
            The lessee will pay at the expiry date his provisions, his estimated bills and his share of the common charges of the immovable relative to the rented property, on the basis of the statements of the trustee, the lessor or his representative. Common expenses include, among others, water consumption, gas consumption. electricity, heating and maintenance of the building and its possible annexes, as well as those relating to lighting, elevators, technical equipment, costs relating to accounts, contrasts and security, remuneration the trustee (or the regisseur - private manager - in the absence of a trustee), the salary and expenses of the concierges, any expenses and repairs made to the common parts as a result of criminal acts or vandalism.
          </p>
          <p>
            The lessee will participate in proportion to his expenses to the payment of the insurance of the building covering the fire risks. water damage, broken windows.
          </p>
          <p>
            If the cleaning of the common parts is not carried out by personnel responsible for this work, the lessee will maintain, in agreement with the other occupants of the building, the landing of his floor and the staircase between it and the building. lower floor (if the rented property is located on the ground floor, the lessee will maintain the entrance hall and sidewalk). In the absence of agreement or in the case of a justified claim by an occupant, the lessee undertakes to pay his share of the cleaning costs which would be ordered by the lessor.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 6. TAXES</span></td>
      </tr>
      <tr>
        <td>
          <p>
            All impels and taxes of any kind directly or indirectly related to the leased property (such as the garbage collection tax) will be payable by the lessee, except for real estate tax if the leased premises are assigned to the lessee's principal residence.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 7. PROVISIONS - PACKAGES</span></td>
      </tr>
      <tr>
        <td><p>In the absence of a transit meter and unless a flat rate is applied, the share of the lessee is fixed as a result of the total consumption of the building:</p>
        </td>
      </tr>
      @if(count($data['meters']) > 0 )
          @foreach($data['meters'] as $key => $meter)
          <tr>
                <td>- @if($meter->meter_type == 'gas_meter')
                          Gas meter
                      @elseif($meter->meter_type == 'water_meter')
                          Water meter
                      @elseif($meter->meter_type == 'electric_meter')
                          Electric meter
                      @endif
                  <strong>{{$meter->consumption}}% of total consumption</strong></td>
          </tr>
      @endforeach
      @endif
      <tr>
        <td><span>The lessee will pay at the same time as his rent the following amounts:</span></td>
      </tr>
      <tr>
        <td>
          <span>- for heating, electricity, hot and cold water:<strong> {{$data['cost_provision'] / $data['fix_price']}} {{Helper::currencyType()}}/month</strong></span>
        </td>
      </tr>
      <tr>
        <td>
          <span>- for common expenses: <strong>{{$data['cost_provision'] / $data['fix_price']}} {{Helper::currencyType()}}/month</span>
        </td>
      </tr>
      <tr>
        <td>
          <span>- other: <strong>{{$data['cost_provision'] / $data['fix_price']}} {{Helper::currencyType()}}/month</strong></span>
        </td>
      </tr>
      <tr>
        <td>
          <p>-  A total of:
            <span class="ml-30"><strong>{{($data['cost_provision'] / $data['fix_price']) * 3}} {{Helper::currencyType()}}/month</strong></span>
          </p>
        </td>
      </tr>
      <tr>
        <td>
          <p>
            These provisions are established by mutual agreement between the parties on the basis of past consumption and the number of people who will live in the rented building. The estimate of the amount of the charges is purely indicative and the actual amount will depend on the actual consumption by the occupant (s).
          </p>
          <p>
            For provisions, at least once a year, a detailed statement of charges will be sent to the lessee. On receipt, the lessor or lessee will pay to the other party the difference between the provisions paid and the actual expenses. On this occasion, the subsequent provisions may be readjusted on the basis of actual expenses. The packages will be indexed annually and the indexation due on each anniversary date of the taking of the lease.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 8. DEPOSIT/GUARANTEE</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The lessee is required to provide a guarantee of compliance with his obligations. It will be returned at the end of the lease, after ascertainment of the good and complete performance of all the lessee's obligations and justification by the lessee of the payments due in accordance with articles 5, 6 and 7 of this lease. In the event of a change of lessor, the new lessor will be subrogated to the terms and obligations of the current lessor. The guarantee/deposit will be transferred on simple notification of the new lessor's contact details to the person holding the guarantee.
          </p>
          <p>
            Unless agreed by the parties, the refund of the guarantee will not discharge any balances due, with the exception of those liquidated at the end of the lease. In the meantime, the guarantee can not be used to pay one or more rents or charges. The guarantee will be updated each triennium according to the evolution of rent and / or charges (only rent on a principal residence lease).
          </p>
        </td>
      </tr>
      <tr>
        <td><span>Method of constitution:</span></td>
      </tr>
      <tr>
        <td>
          <span>
            Account blocked in the name of the lessee at <strong>{{$data['company_name']}}</strong> having its registered office in <strong>{{$data['country']}} </strong> for an amount of (maximum equivalent of two months' rent on a principal residence lease with capitalization of interest). The lessor assumes no obligation to manage these values. At the request of the lessee, he will release against other equivalent values, those which would give place to exchange, refund or which risk a depreciation. The guarantor must undertake to pay the lessor the amounts resulting from the possible non-performance by the lessee of his obligations, upon production of an agreement between the parties or a court order. If the lessor is a rental professional, the Lessee will give the Lessor, before the taking of course of this lease, the bonding contract established in accordance with articles 2043 bis and following of the Civil Code. The guarantee period must be at least in accordance with the duration of the lease, and its call made possible in time materially and legally necessary.
          </span>   
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 9. AMOUNTS NOT PAID AT TIME</span></td>
      </tr>
      <tr>
        <td>
          <p>
            Any amount owed by the lessee pursuant to this lease and not paid on its due date will automatically be in favor of the lessor, without prior notice, interest of 12% per annum from the due date.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 10. INSURANCE - ACCIDENTS - RESPONSIBILITIES - REPAIRS - MAINTENANCE</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The lessee must be insured, throughout the duration of the lease for its civil liability, against rental risks such as fire. water damage and broken glass, as well as against the use of neighbours. This insurance will include for the insurer the prohibition to terminate the policy without notice to the lessor. The lessee must provide proof of this insurance before entering the premises. The lessor will be responsible for major repairs to the rented property including, among others. repairs to roofing and structural work, painting and exterior carpentry. The lessee is obliged to inform the lessor, if necessary, of the damage suffered by the leased property and the repairs that it is necessary to carry out, the repair of which is the responsibility of the lessor; failing to do so, the lessee will incur the lessee. The lessee will have to tolerate, without indemnity, the major repairs carried out by the lessor, even if the work lasts more than forty days. He will take care to collaborate and give access to the Lessor in the event of work incumbent on him. With the exception of major repairs, it supports the costs of the rented property and its private access by criminal acts. The lessor will not be responsible for accidental shutdown or malfunction. it is attributable to services and appliances serving the leased premises, if it is established that, having been notified, it did not take any steps to remedy the situation as soon as possible. The lessee is responsible for the rental and maintenance repairs as well as the repairs Usually falling on the lessor, but necessitated by the lessee or by a third party incurring the lessee's responsibility. The lessee will have the chimneys and other evacuation ducts serviced annually. All installations, pipes and equipment shall be maintained by the lessee in good working order and shall be protected from frost and other risks. If the accommodation is equipped with a private elevator, the lessee will be responsible for taking out a maintenance contract with an authorized firm and scrupulously respecting the clauses. The lessee will arrange for the maintenance and overhaul of the sanitary, personal heating and safety installations, including descaling, periodical legal inspections and the replacement of faucets. the unclogging of the pipes, etc. The lessee acknowledges having received from the lessor the logbook of the heating system and will make it available to the workers on the boiler. He is obliged to check the wells regularly (septic tanks, cisterns, etc.) and to clean the pipes. It will keep the shutters in good condition, and maintain the garden, as well as the terraces and private areas, in good condition. It will replace all broken or cracked windows, whatever the cause.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 11. RULES OF ORDER - COMMON PARTIES - ENJOYMENT</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The lessee undertakes to respect the basic act, the rules of procedure and the decisions of the general meeting of the co-owners and their modifications and to ensure the respect by the persons whose he answers. The lessee can request the information from the lessor. Unless expressly authorized by the lessor, the lessee may not keep any animals in the rented premises. The obligation of the lessee to enjoy the rented premises as a good father applies equally to the common parts or accessories of the building in which the rented premises are located.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 12. ASSIGNMENT - SUBLOCATION</span></td>
      </tr>
      <tr>
        <td>
          <p>
            The rented premises can be modified only with the prior written agreement of the lessor: unless otherwise agreed, the modifications will be acquired without compensation by the lessor. In the absence of written agreement from the lessor, he may demand that the premises be restored to their original state.
          </p>
          <p>
          The lessee may not assign his rights or sublet the property without the prior written consent of the lessor.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 13. STATUS OF ENTRY AND EXIT</td>
      </tr>
      <tr>
        <td>
          <p>
            Before the entry of the property by the lessee, a detailed inventory will be drawn up by an expert at common expenses, as well as, if necessary an inventory of the furniture; in the second case, the parties are mandating for this purpose <strong>{{$data['expert']}} </strong> as an expert. 
          </p>
          <p>
          This expert is mandated to proceed also the inventory of places of exit rental. At both entry and exit, the parties will be bound by the decision of the expert, except in cases of fraud, factual or material error. or contradiction. In the absence of expert intervention at the exit, the lessor and lessee will visit the premises, after removal of the furniture in the case of a rented unfurnished property.
        </p>
        <p>
          Saul parties agree, the inventory will be, regardless of its author made at the earliest the last day of rental, it must coincide with the release of the premises.
        </p>
        <p>
          The expert will take the indexes of all the meters.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 14. DISPLAYS - VISITS</td>
      </tr>
      <tr>
        <td>
          <p>
            In case of sale of the rented property or three months before the end of the lease, for the purpose of the relocation, the lessee will have to tolerate, until the day of its release, that placards are affixed to visible places and that the amateurs can visit him freely and completely three days a week at the rate of two consecutive days a day or twice a week for 3 consecutive hours, to be determined by mutual agreement. Throughout the term of the lease, the lessor or his delegate may visit the rented premises by appointment
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 15. EXPROPRIATION</td>
      </tr>
      <tr>
        <td>
          <p>
            In case of expropriation of the good loud. The lessee can not claim any compensation from the lessor; he may assert his rights only against the expropriator.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 16. RESOLUTION TO THE TORTS OF THE LESSEE</td>
      </tr>
      <tr>
        <td>
          <p>
            In the case of resolution by the fault of the lessee, the parties set the rental compensation for breach of contract at a flat rate of three months' rent. In addition, the lessee shall bear, in addition to the current rent and all expenses, all costs, disbursements and costs arising from this resolution.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 17. ELECTION OF DOMICILE - CIVIL STATUS</td>
      </tr>
      <tr>
        <td>
          <p>
            The lessee is domiciled in the rented premises for the duration of the lease. It will be the same later for all the consequences of the lease, if it has not notified the lessor The existence of a new domicile in Belgium. The lessee is obliged to inform the lessor without delay of any change in his marital status and any change of residence of the persons having the right to the lease.
          </p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Art 19. OTHER CLAUSES</td>
      </tr>
      <tr>
        <td>
          <p>
            The lessee may not, unless otherwise agreed by the lessor, dispose of the premises until he has satisfied the following obligations:
          </p>
        </td>
      </tr>
      <tr>
        <td><span>- Signed Rental Agreement and Entry Place Description</span></td>
      </tr>
      <tr>
        <td><span>- Establishment of the rental guarantee/deposit;</span></td>
      </tr>
      <tr>
        <td><span>- Payment of the first month's rent;</span></td>
      </tr>
      <tr>
        <td><span>- Copy ID Card</span></td>
      </tr>
      <tr>
        <td><span>- Guarantee (if applicable see art8)</span></td>
      </tr>
      <tr>
        <td><p>The reciprocal rights and obligations of the parties are governed by this Agreement. For all that has not been settled in this agreement, Belgian law is applicable.</p></td>
      </tr>
      <tr>
        <td><p>Done at <u>PLACE OF LESSOR</u> the <u>DATE OF SIGNATURE</u> in as many original copies as there are parts, plus one intended for registration, each signatory acknowledging having received his.</p></td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><img src="{{url('images/users/'.$data['lessor_signature'])}}" alt="Smiley face" height="50" width="120"></td>
        <td>
          <p style="color: red;"><img src="{{url('images/users/'.$data['lessee1_signature'])}}" alt="Smiley face" height="50" width="120"></p>
          @if(isset($data['coTenant']) && count($data['coTenant']) > 0)
            @foreach($data['coTenant'] as $key => $value)
              <p style="color: red;"><img src="{{url('images/users/'.$data['lessee1_signature'])}}" alt="Smiley face" height="50" width="120"></p>
            @endforeach
          @endif
        </td>
      </tr>
      <tr>
        <td><span>The Lessor</span></td>
        <td><span>The lessee</span></td>
      </tr>
    </table>
    
    <table style="margin: 0;">
      <tr>
        <td><p>
          The guarantor must undertake to pay the lessor the amounts resulting from the possible non-performance by the lessee of his obligations.</p>
        </td>
      </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Name and First Name:</span></td>
        <td><span style="color: red;">{{$data['guarantor_name']}}</span></td>
        <td><span>ID Card / Passport Nr:</span></td>
        <td><img src="{{url('images/guarantor/'.$data['guarantor_id_proof'])}}" alt="Smiley face" height="50" width="120"></td>
      </tr>
      <tr>
        <td><span>Street, Number:</span></td>
        <td><span style="color: red;">{{$data['guarantor_address']}}</span></td>
        <td><span>Postal Code, Commune:</span></td>
        <td><span style="color: red;">{{$data['lessor_postal']}}</span></td>
      </tr>
      <tr>
        <td><span>Phone / Mobile:</span></td>
        <td><span style="color: red;">{{$data['guarantor_phone']}}</span></td>
        <td><span>Email:</span></td>
        <td><span style="color: red;">{{$data['guarantor_email']}}</span></td>
      </tr>
    </table>

    <table style="margin: 0;">
        <tr>
            <td align="center">
                <p style="color: red;"><img src="{{url('images/users/'.$data['guarantor_signature'])}}" alt="Smiley face" height="50" width="120"></p>
                <p>The Guarantor</p>
            </td>
        </tr>
    </table>

    <table style="margin: 0;">
      <tr>
        <td><span>Attachments</td>
      </tr>
      <tr>
            <td>1. Place Description</td>
        </tr>
        <tr>
            <td>2. Royal Decree of 8 July 1997 determining the minimum conditions to be fulfilled in order for a property to be rented as a principal residence to comply with the basic requirements of security and habitability.</td>
        </tr>
        <tr>
            <td>3. Annex to the Royal Decree of 4 May 200 / made in pursuance of Article 11 bis of Note 111, Title VIII. Chapter II, Section It, of the Civil Code. Rent for rent in the Flemish Region / in the Walloon Region / in the Brussels Region</td>
        </tr>
        <tr>
            <td>4. Energétigue Certificate of Performancede «'article 11 bis, du liure 111, Titre VIII. chapitre II, section It, du code civil. Baux a loyer relatifs aux logements situes en Régions Flamande / en Région Wallonne / en Région Bruxelloise</td>
        </tr> 
        <tr>
            <td>5. Other</td>
        </tr>
    </table>

</body>
</html>