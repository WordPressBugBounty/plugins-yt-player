import Content from '../Parts/Content';
import Header from '../Parts/Header';

const Layout = ({ children }) => {
  const navigation = [
    { name: 'Welcome', href: '/video' },
    { name: 'Preview', href: '/preview' }
  ]

  return (
    <>
      <div className="bplContainer">
        <Header navigation={navigation} />
        <Content>{children}</Content>
      </div>
    </>
  )
}

export default Layout;