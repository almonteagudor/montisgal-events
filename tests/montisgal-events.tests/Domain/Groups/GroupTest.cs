using montisgal_events.domain.Groups;
using montisgal_events.domain.Shared.Exceptions;

namespace montisgal_events.tests.Domain.Groups;

public class GroupTest
{
    [Fact]
    public void Constructor_WithWhiteSpaceName_ThrowsDomainValidationException()
    {
        const string name = "   ";
        
        try
        {
            _ = new Group(Guid.NewGuid(), name, "Desription", true, Guid.NewGuid());
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
        }
    }
    
    [Fact]
    public void Constructor_WithShortName_ThrowsDomainValidationException()
    {
        const string name = "AB";

        try
        {
            _ = new Group(Guid.NewGuid(), name, "Desription", true, Guid.NewGuid());
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
        }
    }
    
    [Fact]
    public void Constructor_WithShortValidName_OK()
    {
        const string name = "ABC";

        var group = new Group(Guid.NewGuid(), name, "Desription", true, Guid.NewGuid());
        
        Assert.Equal(name, group.Name);
    }
    
    [Fact]
    public void Constructor_WithLongName_ThrowsDomainValidationException()
    {
        var name = new string('*', 101);
        
        try
        {
            _ = new Group(Guid.NewGuid(), name, "Desription", true, Guid.NewGuid());
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
        }
    }
    
    [Fact]
    public void Constructor_WithLongValidName_OK()
    {
        var name = new string('*', 100);

        var group = new Group(Guid.NewGuid(), name, "Desription", true, Guid.NewGuid());
        
        Assert.Equal(name, group.Name);
    }
    
    [Fact]
    public void Constructor_WithNullDescription_OK()
    {
        var group = new Group(Guid.NewGuid(), "Name", null, true, Guid.NewGuid());
        
        Assert.Null(group.Description);
    }
    
    [Fact]
    public void Constructor_WithWhiteSpaceDescription_ThrowsDomainValidationException()
    {
        const string description = "   ";

        try
        {
            _ = new Group(Guid.NewGuid(), "Name", description, true, Guid.NewGuid());
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("description", e.Errors);
        }
    }
    
    [Fact]
    public void Constructor_WithLongDescription_ThrowsDomainValidationException()
    {
        var description = new string('*', 1001);
        
        try
        {
            _ = new Group(Guid.NewGuid(), "Name", description, true, Guid.NewGuid());
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("description", e.Errors);
        }
    }
    
    [Fact]
    public void Constructor_WithLongValidDescription_OK()
    {
        var description = new string('*', 1000);
        var group = new Group(Guid.NewGuid(), "Name", description, true, Guid.NewGuid());
        
        Assert.Equal(description, group.Description);
    }
    
    [Fact]
    public void Constructor_WithMultipleErrors_ThrowsDomainValidationExceptionWithMultipleErrors()
    {
        var name = new string('*', 101);
        var description = new string('*', 1001);

        try
        {
            _ = new Group(Guid.NewGuid(), name, description, true, Guid.NewGuid());
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
            Assert.Contains("description", e.Errors);
        }
    }
    
    [Fact]
    public void SetName_WithWhiteSpaceName_ThrowsDomainValidationException()
    {
        const string name = "   ";

        var group = new Group(Guid.NewGuid(), "Name", "Desription", true, Guid.NewGuid());
        
        try
        {
            group.Name = name;
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
        }
    }
    
    [Fact]
    public void SetName_WithShortName_ThrowsDomainValidationException()
    {
        const string name = "AB";
        
        var groupo = new Group(Guid.NewGuid(), "Name", "Desription", true, Guid.NewGuid());
        
        try
        {
            groupo.Name = name;
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
        }
    }
    
    [Fact]
    public void SetName_WithShortValidName_OK()
    {
        const string name = "ABC";

        var group = new Group(Guid.NewGuid(), "Name", "Desription", true, Guid.NewGuid());

        group.Name = name;
        
        Assert.Equal(name, group.Name);
    }
    
    [Fact]
    public void SetName_WithLongName_ThrowsDomainValidationException()
    {
        var name = new string('*', 101);
        
        var group = new Group(Guid.NewGuid(), "Name", "Desription", true, Guid.NewGuid());
        
        try
        {
            group.Name = name;
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("name", e.Errors);
        }
    }
    
    [Fact]
    public void SetName_WithLongValidName_OK()
    {
        var name = new string('*', 100);

        var group = new Group(Guid.NewGuid(), "Name", "Desription", true, Guid.NewGuid());

        group.Name = name;
        
        Assert.Equal(name, group.Name);
    }
    
    [Fact]
    public void SetDescription_WithNullDescription_OK()
    {
        var group = new Group(Guid.NewGuid(), "Name", "Description", true, Guid.NewGuid());

        group.Description = null;
        
        Assert.Null(group.Description);
    }
    
    [Fact]
    public void SetDescription_WithWhiteSpaceDescription_ThrowsDomainValidationException()
    {
        const string description = "   ";
        
        var group = new Group(Guid.NewGuid(), "Name", "Description", true, Guid.NewGuid());

        try
        {
            group.Description = description;
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("description", e.Errors);
        }
    }
    
    [Fact]
    public void SetDescription_WithLongDescription_ThrowsDomainValidationException()
    {
        var description = new string('*', 1001);
        
        var group = new Group(Guid.NewGuid(), "Name", "Description", true, Guid.NewGuid());
        
        try
        {
            group.Description = description;
        }
        catch (DomainValidationException e)
        {
            Assert.Contains("description", e.Errors);
        }
    }
    
    [Fact]
    public void SetDescription_WithLongValidDescription_OK()
    {
        var description = new string('*', 1000);
        
        var group = new Group(Guid.NewGuid(), "Name", "Description", true, Guid.NewGuid());

        group.Description = description;
        
        Assert.Equal(description, group.Description);
    }
}