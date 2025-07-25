import { NavLink } from 'react-router-dom';

const Header = ({ navigation }) => {

  return (
    <div className="dashboard-heading-container">
      <div className="dashboard-heading">
        <div className="heading">
          <img className="block-logo" src="https://ps.w.org/yt-player/assets/icon-128x128.png" alt="CustomHtmlIcon" />
          <h1 className="heading-title"> Video Player for YouTube </h1>
        </div>
        <div className="plugin-version"> v2.0.0 </div>
      </div>

      {/* Links */}
      <div className="navLinks">
        <div className='firstLinks'>
          {
            navigation.map((item, index) => {
              return (<NavLink key={index} to={item.href} className={`links ${({ isActive }) => isActive ? 'active' : ''}`}>
                {item.name} </NavLink>)
            })
          }
        </div>

      </div>
    </div>
  );
};

export default Header;