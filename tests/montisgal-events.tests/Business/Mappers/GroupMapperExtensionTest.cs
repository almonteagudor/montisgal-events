using montisgal_events.Business.Mappers;
using montisgal_events.Data.Entities;

namespace montisgal_events.tests.Business.Mappers;

public class GroupMapperExtensionTest
{
    [Fact]
    public void ToDto_WhenCallingFromAnEntity_ThenSuccess()
    {
        var groupEntity = new GroupEntity(Guid.NewGuid(), "stringName", "stringDescription", true, "");
        var groupDto = groupEntity.ToDto();
        
        Assert.Equal(groupEntity.Id, groupDto.Id);
        Assert.Equal(groupEntity.Name, groupDto.Name);
        Assert.Equal(groupEntity.Description, groupDto.Description);
        Assert.Equal(groupEntity.IsPublic, groupDto.IsPublic);
    }
    
    [Fact]
    public void ToDto_WhenCallingFromAList_ThenSuccess()
    {
        var groupEntityList = new[] {
            new GroupEntity(Guid.NewGuid(), "stringName1", "stringDescription1", true, ""),
            new GroupEntity(Guid.NewGuid(), "stringName2", "stringDescription2", false, "")
        };
        
        var groupDtoList = groupEntityList.ToDto();
        
        Assert.Equal(groupEntityList[0].Id, groupDtoList[0].Id);
        Assert.Equal(groupEntityList[0].Name, groupDtoList[0].Name);
        Assert.Equal(groupEntityList[0].Description, groupDtoList[0].Description);
        Assert.Equal(groupEntityList[0].IsPublic, groupDtoList[0].IsPublic);
        
        Assert.Equal(groupEntityList[1].Id, groupDtoList[1].Id);
        Assert.Equal(groupEntityList[1].Name, groupDtoList[1].Name);
        Assert.Equal(groupEntityList[1].Description, groupDtoList[1].Description);
        Assert.Equal(groupEntityList[1].IsPublic, groupDtoList[1].IsPublic);
    }
}