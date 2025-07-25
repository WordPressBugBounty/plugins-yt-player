import { useState } from 'react';

import { externalIcon } from '../../utils/icons';

import "./style.scss";
import { content, demos } from './data';
import ExternalButtons from './ExternalButtons';
const DemoTwo = () => {

  const { title, description } = content || {};

  const [activeDemo, setActiveDemo] = useState(demos[0]);
  const [activeIndex, setActiveIndex] = useState(0);
  const [isLoading, setIsLoading] = useState(false);

  const handleDemoChange = (index) => {
    setIsLoading(true);
    setActiveDemo(demos[index]);
    setActiveIndex(index);
    setTimeout(() => setIsLoading(false), 800);
  };

  const prefix ="bPluginsDemos"

  return <div className={prefix}>
    {/* Left Sidebar - Demo Tabs */}
    <div className='sidebar'>
      <div className='sidebarHeader'>
        <div>
          {title && <h2 className='wp-block-heading' dangerouslySetInnerHTML={{ __html: title }} />}
          {description && <p dangerouslySetInnerHTML={{ __html: description }} />}
        </div>

        <ExternalButtons content={content} activeDemo={activeDemo} style='white' />
      </div>

      <div className='sidebarList'>
        {demos.map((demo, index) => {
          const { icon, title, description, category } = demo;

          const isActive = activeIndex === index;

          return <button key={index} className={isActive ? 'active' : ''} onClick={() => handleDemoChange(index)}>
            {icon && <div className='iconBox' dangerouslySetInnerHTML={{ __html: icon }} />}

            <div className='texts'>
              {title && <h4>{title}</h4>}

              {description && <p>{description}</p>}

              {category && <span className='category'>{category}</span>}
            </div>

            {isActive && <div className='externalIcon'>{externalIcon}</div>}
          </button>
        })}
      </div>
    </div>

    {/* Right Content - Demo Preview */}
    <div className='main'>
      {/* Demo Header */}
      <div className='mainHeader'>
        <div className='headerInfo'>
          <h3>{activeDemo.title}</h3>
          <p>{activeDemo.description}</p>
        </div>

        <ExternalButtons content={content} activeDemo={activeDemo} />
      </div>

      {/* Demo Preview */}
      <div className='canvas'>
        {isLoading && <div className='loading'>
          <div className='loadingContent'>
            <div className='spinner'></div>
            <p className='loadingText'>Loading demo...</p>
          </div>
        </div>}

        <div className='demo-image-preview-container'>
          <img className='demo-image-preview' src={activeDemo.url} alt={activeDemo.title} onLoad={() => setIsLoading(false)} />
        </div>
      </div>

      {/* Demo Footer */}
      <div className='mainFooter'>
        <span>Preview of <strong>{activeDemo.title}</strong></span>
      </div>
    </div>
  </div>
}
export default DemoTwo;