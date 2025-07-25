import { externalIcon } from '../../utils/icons';

const ExternalButtons = ({ content, activeDemo, style = '' }) => {
    const { openDemoLabel, allDemosLabel, allDemosLink } = content || {};

    return <div className='wp-block-buttons is-layout-flex'>
        <div className={`wp-block-button one ${style}`}>
            <a className='wp-block-button__link wp-element-button' href={activeDemo.url} target='_blank' rel='noreferrer'>{externalIcon} {openDemoLabel}</a>
        </div>

        {allDemosLink && <div className={`wp-block-button two ${style}`}>
            <a className='wp-block-button__link wp-element-button' href={allDemosLink} target='_blank' rel='noreferrer'>{allDemosLabel}</a>
        </div>}
    </div>
}
export default ExternalButtons;