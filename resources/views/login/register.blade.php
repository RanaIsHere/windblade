@extends('preload.default')

@section('container')
<div class="flex m-4">
    <ul class="steps steps-vertical md:steps-horizontal w-full" id="step-tracking">
        <li class="step transition-all step-primary">Basic User Information</li>
        <li class="step transition-all ">Outlet Information</li>
        <li class="step transition-all ">Admin Registration</li>
        <li class="step transition-all ">Finishing Up</li>
    </ul>
</div>

<form action="/register-owner" method="post" id="register-owner-page">
    @csrf

    <div class="flex m-0 lg:m-10 bg-base-200 px-1 lg:px-60" id="basic_user_information">
        <div class="card w-full shadow-2xl bg-base-100 my-10">
            <div class="card-body">
                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Full Name</span>
                    </label>
                    <input type="text" name="name" placeholder="full name" class="input input-bordered">
                </div>

                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" placeholder="username" class="input input-bordered">
                </div>

                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="password" class="input input-bordered">
                </div>
            </div>

            <div class="my-6 text-center">
                <button type="button" class="btn btn-primary"
                    onclick="next_page('basic_user_information', 'outlet_information', 1)" onkeydown="">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div class="flex m-0 lg:m-10 bg-base-200 px-1 lg:px-60 hidden" id="outlet_information">
        <div class="card w-full shadow-2xl bg-base-100 my-10">
            <div class="card-body">
                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Outlet Name</span>
                    </label>
                    <input type="text" name="outlet_name" placeholder="outlet name" class="input input-bordered">
                </div>

                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Outlet Address</span>
                    </label>
                    <input type="text" name="outlet_address" placeholder="outlet address" class="input input-bordered">
                </div>

                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Outlet Contact</span>
                    </label>
                    <div class="input-group">
                        <span>+62</span>
                        <input type="text" name="outlet_phone" placeholder="outlet contact"
                            class="input input-bordered w-full">
                    </div>
                </div>
            </div>

            <div class="my-6 text-center">
                <button type="button" class="btn btn-primary"
                    onclick="next_page('outlet_information', 'admin_registration', 2)">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div class="flex m-0 lg:m-10 bg-base-200 px-1 lg:px-60 hidden" id="admin_registration">
        <div class="card w-full shadow-2xl bg-base-100 my-10">
            <div class="card-body">
                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Full Name</span>
                    </label>
                    <input type="text" name="admin_name" placeholder="full name" class="input input-bordered">
                </div>

                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="admin_username" placeholder="username" class="input input-bordered">
                </div>

                <div class="form-control my-4">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="admin_password" placeholder="password" class="input input-bordered">
                </div>
            </div>

            <div class="my-6 text-center">
                <button type="button" class="btn btn-primary"
                    onclick="next_page('admin_registration', 'finishing_up', 3)">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div class="flex m-0 lg:m-10 bg-base-200 px-1 lg:px-60 hidden" id="finishing_up">
        <div class="card w-full shadow-2xl bg-base-100 my-10">
            <div class="card-body">
                <div class="overflow-y-auto h-[500px]">
                    <div class="bg-base-200 text-justify">
                        <h1 class="text-3xl text-center"> Terms Of Service</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt quo blanditiis expedita
                            nulla incidunt natus voluptatum debitis cumque quasi, quia officia fugiat facere ut
                            perferendis, tenetur reiciendis hic qui libero? Atque provident aspernatur tempore dolorum,
                            recusandae fugiat sed iste quae molestias laudantium dignissimos facilis expedita explicabo
                            beatae aliquid temporibus nobis voluptatibus, placeat accusantium id sit officia odit
                            libero! Quia voluptatem velit iste odio officiis eius dolore repudiandae voluptas eligendi
                            explicabo tempore possimus facilis ipsum, odit quos pariatur, voluptates accusamus voluptate
                            nihil. Et optio amet laudantium ut praesentium vel, facilis asperiores dolor. Minus atque et
                            totam facere odio, quam debitis rerum?</p>
                        <p>Consequuntur sunt magni veritatis aspernatur, doloremque numquam voluptatem quae repellendus
                            sapiente enim doloribus! Quae quam ea molestiae facilis consectetur excepturi, suscipit
                            sapiente aut voluptatum quasi quaerat tempore fugit obcaecati repellendus quod voluptates
                            illum architecto totam officiis fugiat, doloremque enim! Blanditiis incidunt voluptatem eius
                            aliquam libero impedit eveniet neque fugiat? Cumque rerum maiores mollitia ab voluptates
                            possimus accusantium placeat eaque, asperiores illum ut assumenda, autem laudantium in
                            doloremque tenetur fugit facilis nihil itaque? Aliquam possimus nisi ipsa, veniam corrupti
                            magnam accusamus consequuntur laudantium nobis at alias non necessitatibus nesciunt? A quam
                            provident excepturi. Exercitationem eius soluta nesciunt consectetur vitae, expedita
                            doloremque.</p>
                        <p>Unde dignissimos eveniet odit quaerat. Recusandae, facere maxime facilis doloremque natus rem
                            voluptates quasi tempore dolore, praesentium cupiditate beatae officia veritatis vel cum
                            qui, ipsum nihil animi dolorum. Earum magnam deleniti fuga praesentium. Quaerat illo totam
                            architecto doloribus! Deserunt dolores velit repudiandae fugit molestiae omnis. Minima,
                            obcaecati ea. Itaque delectus, eligendi odit quis reiciendis neque illo in cum atque. Sunt
                            modi, rem dolor explicabo eum veniam amet labore. Sed vero vel, mollitia corporis eveniet
                            repellendus? Nobis, assumenda! Alias, nesciunt officiis. Neque, quia sit perferendis odit
                            nobis a voluptatum animi cum fugit in facere sed dolorum dolor provident ipsa accusantium
                            quasi!</p>
                        <p>Perspiciatis facilis dolor amet nostrum, perferendis vitae molestiae. Asperiores omnis beatae
                            soluta illo voluptate nisi unde itaque nemo dolorum aperiam saepe voluptates aliquam, minus
                            eum iure nam repellat delectus animi quaerat temporibus debitis. Earum rerum officiis iste
                            quod tempora debitis libero asperiores laborum quis est necessitatibus, laboriosam nulla
                            explicabo qui, dolor numquam assumenda. Non rerum expedita ducimus quod itaque vel labore
                            iste atque voluptates temporibus. Adipisci tenetur sint unde. Enim, ipsum. Iste eius sunt
                            sed, quidem aut aliquid unde? Dolores modi omnis animi assumenda exercitationem atque
                            tempora minima soluta esse qui voluptas nam laborum nihil expedita, at fugit enim dolorum.
                        </p>
                        <p>Sapiente aspernatur dolorem facilis eligendi molestiae delectus asperiores corporis, et
                            incidunt sequi similique distinctio quas, velit debitis, quis nemo veritatis odio omnis hic
                            quos vero optio qui? Quam facere cupiditate aliquid ducimus quidem ea sit nulla doloribus.
                            Facilis distinctio fuga dolore molestiae inventore dicta. Omnis voluptas laboriosam impedit
                            quos iusto labore officia. Eum consequatur vero sunt voluptate quae perferendis recusandae!
                            Modi cumque, blanditiis nesciunt, aliquid incidunt, delectus cupiditate tempora voluptatum
                            vel earum distinctio totam! Cumque impedit repellendus fugit. Quaerat perspiciatis inventore
                            dolore rerum eligendi consequuntur vitae? Omnis, modi libero hic esse ipsum vel placeat nam
                            quasi iusto, nesciunt quaerat labore.</p>
                        <p>Vero hic doloribus minus ipsum eum maiores consequuntur, facilis similique, mollitia nihil,
                            nulla error. Laboriosam maxime aut impedit sed. Obcaecati accusamus minima molestias eaque
                            inventore, iure praesentium aperiam labore cum saepe ducimus modi? Ab ipsa, similique
                            dolores iusto veritatis consectetur a saepe id qui voluptates sint voluptatem velit,
                            distinctio deserunt at nisi eligendi expedita magnam mollitia itaque debitis voluptatibus.
                            Fugit, ut. Labore, porro blanditiis illo officia nemo laudantium saepe quidem harum
                            molestiae repellat. Dolorum fugit iure similique expedita quibusdam. Praesentium, iste?
                            Aspernatur voluptate numquam sit qui dolorum vel saepe sequi, dignissimos ad sapiente quam
                            adipisci atque rerum voluptatum suscipit quae.</p>
                        <p>Nisi id vitae, magnam sit accusamus excepturi perferendis tenetur corrupti ab! Eius sit est
                            error a excepturi, voluptates autem iste officia qui reiciendis perspiciatis? Repellendus
                            temporibus, laudantium illum totam autem blanditiis a unde accusantium excepturi ut sapiente
                            nisi obcaecati rerum esse error reiciendis odio ullam omnis quisquam nam ad eaque,
                            necessitatibus eligendi labore. Distinctio recusandae aperiam velit dolor, quaerat, veniam
                            provident quos explicabo, iure placeat adipisci? Tempora voluptatibus illo minima nostrum
                            soluta officia adipisci sed, sunt hic doloremque inventore culpa repudiandae sapiente minus
                            id eligendi excepturi beatae. Ea, commodi nesciunt. Distinctio et provident dignissimos sint
                            inventore tenetur possimus architecto fuga?</p>
                        <p>Doloribus natus voluptatibus unde ab vel earum eius fugiat voluptas velit nisi in perferendis
                            officia ipsa, nulla magni quisquam, sit, facere veniam architecto! Cum asperiores nostrum id
                            voluptatibus fugit accusamus nesciunt molestias quisquam culpa expedita odit, sed ullam
                            error iure impedit deserunt inventore ducimus tempore non incidunt quibusdam laborum, rerum
                            magnam dolorem. Praesentium quasi, nulla perspiciatis voluptatibus beatae dolor aperiam
                            nesciunt accusamus obcaecati, laboriosam similique ab debitis et repellendus, aspernatur
                            alias perferendis cupiditate nemo soluta molestias dicta. Sapiente exercitationem minus
                            magnam eveniet repellendus provident, sint vel modi laudantium maiores eligendi, aspernatur
                            id maxime qui optio. Sed molestias quibusdam doloremque eaque.</p>
                        <p>Neque, a? Dolores nisi autem architecto placeat, earum cum at maxime impedit magni modi
                            deserunt ea sequi repudiandae. Aliquam, impedit maiores. Rerum repellat perferendis
                            repellendus ab aspernatur. Consequuntur fugit optio quis ratione asperiores molestias,
                            dolores voluptatibus neque, sed maxime impedit perferendis harum quisquam vitae quae
                            cupiditate unde molestiae ipsa eius laboriosam ea. Cumque quo voluptatum dolor. Corrupti
                            quod provident sunt libero laudantium vero repudiandae ad iusto et, consectetur natus est
                            quaerat perferendis id nihil a optio repellendus non alias asperiores dicta aliquam, quis
                            deleniti aliquid. Tempora voluptates rem doloribus facilis neque, molestiae harum adipisci
                            at. Voluptas aspernatur asperiores reiciendis nihil!</p>
                        <p>Laboriosam esse molestias voluptas eum! Quidem autem fugit excepturi sint maiores, ad
                            officia, iusto quisquam aliquid necessitatibus a pariatur, distinctio placeat fuga
                            accusantium error hic voluptatem! Libero impedit dolores, quo cumque voluptate deleniti quod
                            iste asperiores quas quasi similique officia eos eum! Ad facilis omnis esse? Minima, sit!
                            Est, aliquid doloremque. Nesciunt, vel. Similique eaque veniam qui vel hic tempore fuga,
                            quisquam beatae architecto deleniti! Dicta optio quaerat sint tempora soluta minus
                            reprehenderit, nam ea nisi itaque odit, quis voluptatibus sapiente quod perspiciatis porro
                            saepe nobis accusamus blanditiis! Alias maxime expedita error. In molestiae ipsam
                            perferendis, omnis quidem beatae sequi.</p>
                        <p>Temporibus vitae rerum debitis possimus ea harum odit quibusdam. Ut suscipit hic asperiores
                            consequuntur omnis mollitia quo ipsa sit doloribus ab, fugit ipsam commodi id placeat qui
                            voluptas, quis doloremque assumenda dicta inventore quibusdam eaque nostrum excepturi
                            facere? Reiciendis mollitia quis iusto odit accusantium consequatur, possimus ratione
                            numquam. Velit nesciunt eligendi sunt eos sapiente quis laudantium, fuga voluptas ad beatae
                            accusamus sit ratione tempore maiores in! Facere modi eum ex beatae repellendus ea. Quaerat
                            cumque ipsum, iusto molestias voluptas laudantium nostrum explicabo! Eveniet culpa
                            voluptatibus odio id, possimus at itaque nihil fuga. Totam libero quas odio laboriosam nobis
                            magni accusamus!</p>
                        <p>Quaerat deserunt optio in dolores sit voluptate dolorum autem amet, iure obcaecati molestiae
                            eaque eius ea officiis aut magnam sunt hic eveniet maxime. Consequuntur iure perspiciatis
                            rem accusamus repellat sunt, magnam, culpa at tempora aliquam distinctio hic! Iure dolorem
                            at esse odio voluptatum in, beatae dolore nostrum aut sit illo? Harum libero maiores
                            voluptas tempore deleniti, hic officia doloremque quam eos reprehenderit nemo commodi est
                            molestias ducimus laborum asperiores rerum neque? Obcaecati quia consequatur quasi eius
                            dolores quaerat ipsam laudantium vitae assumenda id molestiae dolorum illum consequuntur
                            commodi cupiditate suscipit, rerum officia ipsum at ipsa mollitia aspernatur. Iusto,
                            veritatis corporis?</p>
                        <p>Rem assumenda veniam impedit, quasi nam odit mollitia doloribus atque possimus unde, itaque
                            adipisci consectetur eaque architecto qui porro harum earum. Molestiae odio, nihil
                            perspiciatis voluptatibus dolorem aliquam veniam unde culpa enim doloremque possimus maxime
                            quae vero nam minima fugit autem necessitatibus delectus inventore cum magni non! Unde
                            repellendus atque odit nemo asperiores, optio nihil minima labore consectetur porro
                            accusantium culpa, fuga adipisci sapiente qui cum alias fugit, animi commodi aperiam. Vitae
                            similique magnam magni illum quas pariatur dolor doloribus ex rem eligendi natus praesentium
                            libero sit, ut soluta incidunt debitis blanditiis? Qui officia, doloremque vitae perferendis
                            mollitia natus minima.</p>
                        <p>Soluta sint ipsa laudantium quos consequatur placeat? Sed aperiam veniam voluptatem magnam
                            reprehenderit ducimus quo hic totam perferendis velit, molestiae molestias, commodi,
                            mollitia ullam cupiditate. Dicta non beatae nobis, nulla aliquid eius odit exercitationem,
                            voluptas vel sit modi saepe quasi. Rerum dolor earum dolorem nulla molestiae quam eveniet
                            dicta accusamus placeat cumque. Magnam est sed rerum harum deserunt adipisci consequuntur
                            aspernatur voluptatibus corporis odio modi laborum iste quos corrupti ut debitis nesciunt
                            saepe quae earum, dicta, voluptatem totam sequi nam ducimus. A consequatur sed delectus, non
                            deleniti, assumenda quia accusamus eum dignissimos officia beatae nesciunt omnis eligendi
                            voluptatem quibusdam earum.</p>
                        <p>Exercitationem sit earum architecto nulla quasi perspiciatis quidem omnis fugiat, atque quo,
                            debitis dolor temporibus minus beatae dicta voluptatem saepe. Explicabo harum, nulla unde
                            saepe animi voluptatum atque perspiciatis nesciunt aperiam reiciendis molestiae commodi sit
                            qui nobis culpa ut quis laborum quaerat ducimus fugiat! Quod deleniti reprehenderit
                            voluptate, eum ipsam error iure alias, expedita quisquam sapiente, nulla quasi cupiditate
                            consequuntur. Asperiores est recusandae eos exercitationem deleniti ullam quo dolorum id.
                            Quaerat est quam mollitia similique asperiores dolore, placeat necessitatibus quo fugit quod
                            numquam consequuntur quae beatae laudantium illum fuga perferendis officiis expedita
                            repellendus cumque provident iste nostrum veritatis minus. Omnis.</p>
                        <p>Laboriosam animi, vitae harum necessitatibus commodi dolor, iste perferendis facilis ipsam
                            quia rerum tenetur eligendi hic reiciendis earum nisi dolorum laudantium perspiciatis
                            sapiente. Accusamus optio eum culpa repudiandae quis nulla quam qui, eligendi deleniti
                            dignissimos non nihil asperiores sint voluptas nam distinctio, provident ullam sapiente
                            laudantium, quidem unde laboriosam mollitia est sit. Tempora sint cumque eveniet quae
                            obcaecati blanditiis saepe nostrum iste corporis itaque quis voluptatum, maiores iusto a!
                            Dolore accusamus facilis, harum praesentium molestias veniam ducimus qui, cum a illum
                            accusantium eos magnam, voluptates incidunt aliquam necessitatibus minus illo ipsa ab beatae
                            excepturi repellat reiciendis ipsam. Iusto, necessitatibus voluptas!</p>
                        <p>Quae sequi cum veniam ullam inventore, laborum corrupti excepturi repudiandae est, illum
                            magnam amet voluptas cupiditate nihil rerum? Eius quos non labore nihil recusandae itaque
                            iure blanditiis iusto dignissimos, vel, maxime, suscipit aut in vero molestias at
                            reprehenderit ipsam impedit doloribus quibusdam sequi perspiciatis quas ad. Expedita dolores
                            corporis, non officia, maiores illo aspernatur reprehenderit fuga magni dolore incidunt hic
                            ad unde blanditiis nulla nam fugiat ullam, eveniet suscipit commodi eaque vel autem. Dicta
                            dignissimos amet fugit qui impedit doloribus totam, hic animi, blanditiis atque nesciunt
                            explicabo at quasi repellendus dolore eveniet. Enim dignissimos tempora eligendi nostrum
                            impedit quas sit!</p>
                        <p>Consequatur maxime aliquid optio eum nam natus neque facilis dignissimos eveniet dolores ad
                            quos ducimus accusantium delectus fugiat quo, sed nulla ipsum in voluptatum, quae nihil quas
                            repellendus hic. Quod accusantium perspiciatis ducimus aliquam eveniet modi ab quam fuga eum
                            mollitia nihil, in nulla dignissimos, et rerum fugiat cum, numquam libero! Facere fugiat
                            incidunt nam iste, aperiam quaerat tempore, voluptate inventore repellendus quasi distinctio
                            dignissimos natus maiores optio earum, ipsum culpa. Necessitatibus cum maiores explicabo
                            iste quia, architecto assumenda vero reprehenderit! Iure nesciunt quo alias vero modi ex
                            magni qui soluta obcaecati, nulla neque tenetur pariatur voluptatem nostrum cum cumque!</p>
                        <p>Eum laborum, officiis, facere tenetur adipisci sunt porro magni veritatis, voluptates non
                            dolorem facilis? Suscipit debitis doloremque fuga amet laboriosam reiciendis temporibus
                            provident, voluptatem, nesciunt vero eos officiis dignissimos molestias obcaecati recusandae
                            voluptatibus accusamus repellat explicabo ducimus. Accusamus saepe fuga reiciendis
                            voluptatem unde obcaecati veniam deserunt ipsam praesentium iure, placeat similique
                            necessitatibus animi alias aperiam, fugit explicabo earum tempore itaque voluptatum
                            molestiae! Nulla, eos. Ut quibusdam praesentium tempore adipisci impedit eaque vel, ab
                            architecto beatae! Cupiditate suscipit qui ipsa, fugit consequuntur culpa tenetur quidem
                            excepturi cumque eaque a ex quam, est, maxime corporis modi labore. Excepturi dolore
                            accusamus sequi voluptates?</p>
                        <p>Saepe, repellat voluptas corrupti itaque ex impedit earum dicta nobis quasi, cupiditate enim,
                            molestiae officiis quidem hic autem iure corporis? Unde voluptas expedita autem sit hic sint
                            non asperiores accusantium blanditiis a deleniti facere voluptatem vel nostrum, molestias
                            impedit magni? Corrupti qui placeat fugit laborum ducimus illum doloremque voluptatum
                            voluptates! Placeat doloremque delectus possimus debitis at modi sint recusandae numquam eum
                            nobis provident illo labore eius voluptatem, ratione suscipit nemo nulla blanditiis harum
                            beatae ex? Dolore voluptatum accusantium at, mollitia beatae, ipsam necessitatibus inventore
                            dolor eum nostrum optio reiciendis laboriosam, sit officiis et dolorum. Tempora quo quis
                            necessitatibus blanditiis excepturi?</p>
                    </div>
                </div>
            </div>

            <div class="my-6 text-center">
                <div class="p-6 card bordered">
                    <div class="form-control">
                        <label class="cursor-pointer label">
                            <span class="label-text">Accept the term of service</span>
                            <input type="checkbox" class="checkbox checkbox-primary" onclick="
                                document.getElementById('register-btn').classList.remove('pointer-events-none'); 
                                document.getElementById('register-btn').classList.remove('opacity-50');
                                this.setAttribute('disabled', 'disabled');" id="register_checkbox">
                        </label>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary pointer-events-none opacity-50" id="register-btn">
                    Register
                </button>
            </div>
        </div>
    </div>
</form>
@endsection