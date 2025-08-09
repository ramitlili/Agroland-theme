<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;

class Quanto_Faqs extends Widget_Base {

    public function get_name() {
        return 'quantofaqs';
    }

    public function get_title() {
        return __( 'FAQs', 'quanto' );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'quanto' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'faqs_section',
            [
                'label' => __( 'FAQs', 'quanto' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'open_item',
            [
                'label'        => __( 'Open?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'quanto' ),
                'label_off'    => __( 'Hide', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $repeater->add_control(
            'faqs_title',
            [
                'label'       => __( 'Title', 'quanto' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'FAQ Item', 'quanto' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'faqs_desc',
            [
                'label'       => __( 'Description', 'quanto' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Default description.', 'quanto' ),
                'placeholder' => __( 'Type your description here', 'quanto' ),
            ]
        );

        $this->add_control(
            'faqs_repeater',
            [
                'label'       => __( 'FAQs', 'quanto' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ faqs_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="accordion quanto-faq-accordion" id="quantoFaqAccordion">
            <?php foreach ($settings['faqs_repeater'] as $index => $item) :
                $is_open = $item['open_item'] === 'yes' ? 'show' : '';
                $collapsed = $item['open_item'] === 'yes' ? '' : 'collapsed';
                $item_id = 'faq-item-' . $index;
                ?>
                <div class="accordion-item fade-anim">
                    <h6 class="accordion-header" id="heading<?php echo $index; ?>">
                        <button class="accordion-button <?php echo $collapsed; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $item_id; ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo $item_id; ?>">
                            <?php echo esc_html($item['faqs_title']); ?>
                        </button>
                    </h6>
                    <div id="<?php echo $item_id; ?>" class="accordion-collapse collapse <?php echo $is_open; ?>" data-bs-parent="#quantoFaqAccordion">
                        <div class="accordion-body">
                            <?php echo esc_html($item['faqs_desc']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

$widgets_manager->register( new \Quanto_Faqs() );
