import { useState } from 'react';
import Layout from '../../Layout/Layout';
import { helpItem } from '../../utils/options';
import VideoPlayer from './VideoPlayer';
const Video = ({ videoUrl = "https://www.youtube.com/watch?v=NGvVtSXcZK4", isYoutube = true }) => {
  const [isChangeLog, setIsChangeLog] = useState(false);

  const handleCreateNewPage = (e) => {
    e.preventDefault();

    const baseUrl = window.location.origin;
    const adminPath =
      window.location.hostname === "localhost"
        ? "/wordpress/wp-admin/post-new.php?post_type=page"
        : "/wp-admin/post-new.php?post_type=page";
    window.location.href = baseUrl + adminPath;
  };


  return (
    <>
      <Layout>
        <div className="feature-section">
          <div className="feature-container">
            <div className="bblocks_welcome_container">
              <div className="bblocks_left_area">
                <div className="bblocks_left">
                  <h1>Welcome to Video Player for YouTube</h1>
                  <p>Check out our simple video tutorial that guides you through using this plugin step-by-step!</p>
                  <div className="img">
                    <VideoPlayer src={videoUrl} width="100%" height="100%" isYoutube={isYoutube} />

                  </div>
                </div>
                <div className="bblocks_left_btn">
                  <a className='action-button' href="#" onClick={handleCreateNewPage}>
                    Create New Page
                  </a>
                  <a className='action-button' href="https://bplugins.com" target="_blank" rel="noopener noreferrer">
                    Visit Our Website
                  </a>
                </div>
              </div>

              <div className="bblocks_right">
                {helpItem?.map((item, index) => {
                  return (
                    <div key={index} className="item">
                      <h2>{item?.title}</h2>
                      <p>{item?.description}</p>
                      <a className='action-button' href={item?.link} target="_blank" rel="noopener noreferrer">
                        {item?.linkText}
                      </a>
                    </div>
                  );
                })}
              </div>
            </div>
          </div>
        </div>
      </Layout>
    </>
  );
};

export default Video;